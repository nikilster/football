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

var HUGE = "textHuge";
var BIG = "textBig";
var NORMAL = "textNormal";
var SMALLER = "textSmaller";

$(document).ready(function(){

	//Load the carousel images
	loadCarouselImages();

});

/*
	Programatically load the images into the bootstrap carousel
*/
function loadCarouselImages() 
{

	IMAGES = randomizeArray(IMAGES);
	
	//Imported IMAGES & CAPTIONS
	//From images.js
	START_INDEX = 0;

	for(var i=0; i < IMAGES.length; i++)
		addImageWithCaption(IMAGES[i][1], IMAGES[i][2], IMAGES[i][0], START_INDEX == i);
}

/*
	Add to the DOM
*/
function addImageWithCaption(filename, captionText, captionTextSize, active) 
{

	//Add Quotes!
	//captionText = '"' + captionText + '"';

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
		"class": textSizeCSSClass(captionTextSize),
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
	To Size Font
*/
function textSizeCSSClass(textSize) {

	if(textSize == 0) return HUGE;

	if(textSize == 1) return BIG;

	if(textSize == 2) return NORMAL;

	if(textSize == 3) return SMALLER;

	//Handle edge
	return "";
}


/*
	Randomize Array
	(Returns the array)
*/

function randomizeArray(array)
{
	 for(var j, x, i = array.length; i; j = parseInt(Math.random() * i), x = array[--i], array[i] = array[j], array[j] = x);
    return array;
}