const fs = require('fs');
const util = require('util');
const puppeteer = require('puppeteer');
const path = require('path');
const { convertArrayToCSV } = require('convert-array-to-csv');

const headless = true;
const readFile = util.promisify(fs.readFile);

const scrap = async () => {

  const browser = await puppeteer.launch({headless})
  const page = await browser.newPage()

  const lastTalkURL = (await readFile('./lastTalkScrappedURL.txt')).toString()
  const results = []

  let firstTalkURL = ''
  let lastTalkFounded = false
  let pagination = 1;

  while(lastTalkFounded === false){

	  console.log(`await page.goto https://wordpress.tv/page/${pagination}/?s`);
	  await page.goto(`https://wordpress.tv/page/${pagination}/?s`)
	  await page.waitFor('body')

		let talks = await page.evaluate(() => {
	    return Array.from(document.querySelectorAll('.video-list li > a')).map(a => ({ href: a.href, image: a.firstElementChild.src }))
	  })

	  if(pagination === 1){
	  	firstTalkURL = talks[0].href
	  }

	  let counter = 0;

	  while(counter < talks.length){
	  	if(talks[counter].href === lastTalkURL){
	  		lastTalkFounded = true;
	  		break;
	  	}

		  console.log(`await page.goto ${talks[counter].href}`);
		  await page.goto(`${talks[counter].href}`)
		  await page.waitFor('body')

			const result = await page.evaluate((url, image) => {

				const title = document.querySelector('.video-title') != null ? document.querySelector('.video-title').textContent : '';
				const date = document.querySelector('.video-date') != null ? document.querySelector('.video-date').textContent : '';
		    const description = document.querySelector('.video-description') != null ? document.querySelector('.video-description').innerHTML.replace(/(\r\n|\n|\r)/gm,"") : '';
		    const event = document.querySelector('.video-event a') != null ? document.querySelector('.video-event a').firstChild.nodeValue.trim() : '';
		    const event_url = document.querySelector('.video-event a') != null ? document.querySelector('.video-event a').href : '';


		    let speakers = []
		    const speakersDOM = Array.from(document.querySelectorAll('.video-speakers a'));
		    const speakersLength = speakersDOM.length;
		    if(speakersLength){
			    for(let i = 0; i < speakersLength; i++){
			      speakers.push({
			        speaker: speakersDOM[i].firstChild.nodeValue.trim(),
			        url: speakersDOM[i].href
			      });
			    }
		    }
		    speakers = JSON.stringify(speakers);

		    let tags = []
		    const tagsDOM = Array.from(document.querySelectorAll('.video-tags a'));
		    const tagsLength = tagsDOM.length;
		    if(tagsLength){
			    for(let i = 0; i < tagsLength; i++){
			      tags.push({
			        tag: tagsDOM[i].firstChild.nodeValue.trim(),
			        url: tagsDOM[i].href
			      });
			    }
		    }
		    tags = JSON.stringify(tags);

		    const lang = document.querySelector('.video-lang a') != null ? document.querySelector('.video-lang a').firstChild.nodeValue.trim() :'';
		    const lang_url = document.querySelector('.video-lang a') != null ? document.querySelector('.video-lang a').href : '';
		    const producer = document.querySelector('.video-producer a') != null ? document.querySelector('.video-producer a').firstChild.nodeValue.trim() : '';
		    const producer_url = document.querySelector('.video-producer a') != null ? document.querySelector('.video-producer a').href : '';
		    return { title, url, image, date, description, event, event_url, speakers, tags, lang, lang_url, producer, producer_url };
		  }, talks[counter].href, talks[counter].image)

		  results.push(result)
		  counter++
		}
	  pagination++
	}

  browser.close()
  return { results, firstTalkURL }
}

scrap()
  .then(value => {
    const csvFromArrayOfObjects = convertArrayToCSV(value.results, { separator : '|'});
    fs.writeFile('./new.csv', csvFromArrayOfObjects, function(err) {
      if(err) {
        return console.log(err);
      }
      console.log("The file was saved!");
    });

    fs.writeFile('./lastTalkScrappedURL.txt', value.firstTalkURL, () => {});
  })
  .catch(e => console.log(`error: ${e}`))
