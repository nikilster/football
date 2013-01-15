/*
	Nikil Viswanathan
	1/14/2013

	www.facesofharbaugh.com
	www.facesofshaw.com

	main.js

	Load the images in the carousel
*/

var CAROUSEL_INNER_SELECTOR = ".carousel-inner";
var IMAGES_PATH = "web/image/pictures/";
var LONG_TEXT_CLASS = "shortenText";
var EXTRA_LONG_TEXT_CLASS = "reallyShorten";
//Characters
var LONG_LENGTH = 30;
var EXTRA_LONG = 41;

$(document).ready(function(){

	//Load the carousel images
	loadCarouselImages();

});

/*
	Programatically load the images into the bootstrap carousel
*/
function loadCarouselImages() 
{
	//Imported IMAGES & CAPTIONS
	//From images.js
	START_INDEX = 0;

	for(var i=0; i < IMAGES.length; i++)
		addImageWithCaption(IMAGES[i][0], IMAGES[i][1], START_INDEX == i);
}

/*
	Add to the DOM
*/
function addImageWithCaption(filename, captionText, active) 
{

	//Add Quotes!
	captionText = '"' + captionText + '"';

	/*
		Add the Structure (active item for first shown): 

		<div class="active item">
	      <div class="carousel-caption">
	          <h1>Penalty</h1>
	        </div>
	      <img src="web/image/harbaugh/penalty.jpg" alt="">
	    </div>
	*/
	var imageUrl = urlForFilename(filename);

	//Start with?
	var itemCSSClass = active ? "active item" : "item";
	var itemDiv = $('<div/>', {
		"class": itemCSSClass
	});

	var carouselCaptionDiv = $('<div/>', {
		"class": "carousel-caption"
	})

	var caption = $('<h1/>', {
		//Shorten Text
		"class": textSizeCSSClass(captionText),
		//For FitText
		text: captionText
	})


	//Caption -> Caption Div
	carouselCaptionDiv.append(caption);

	var image = $("<img/>", {
		src:imageUrl
	});

	//Put the Caption and Image inside item
	itemDiv.append(carouselCaptionDiv);
	itemDiv.append(image);

	//Add the Item
	$(CAROUSEL_INNER_SELECTOR).append(itemDiv);

}

/*
	Image Path	
*/
function urlForFilename(filename) 
{
	return IMAGES_PATH + filename;
}

/*
	To Shorten String
*/
function textSizeCSSClass(text) {

	if(text.length >= EXTRA_LONG)
		return EXTRA_LONG_TEXT_CLASS;

	if(text.length >= LONG_LENGTH)
		return LONG_TEXT_CLASS;

	return "";
}