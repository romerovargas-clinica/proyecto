(function () {
"use strict";

	//===== Preloader

	window.onload = function () {
		window.setTimeout(fadeout, 500);
	}

	function fadeout() {
		document.querySelector('.preloader').style.opacity = '0';
		document.querySelector('.preloader').style.display = 'none';
	}


	/*=====================================
	Sticky
	======================================= */
	window.onscroll = function () {
		var header_navbar = document.querySelector(".navbar-area");
		var sticky = header_navbar.offsetTop;

		if (window.pageYOffset > sticky) {
			header_navbar.classList.add("sticky");
		} else {
			header_navbar.classList.remove("sticky");
		}



		// show or hide the back-top-top button
		var backToTo = document.querySelector(".scroll-top");
		if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
			backToTo.style.display = "block";
		} else {
			backToTo.style.display = "none";
		}
	};

	// Get the navbar


	// for menu scroll 
	var pageLink = document.querySelectorAll('.page-scroll');

	pageLink.forEach(elem => {
		elem.addEventListener('click', e => {
			e.preventDefault();
			document.querySelector(elem.getAttribute('href')).scrollIntoView({
				behavior: 'smooth',
				offsetTop: 1 - 60,
			});
		});
	});

	// section menu active
	function onScroll(event) {
		var sections = document.querySelectorAll('.page-scroll');
		var scrollPos = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;

		for (var i = 0; i < sections.length; i++) {
			var currLink = sections[i];
			var val = currLink.getAttribute('href');
			var refElement = document.querySelector(val);
			var scrollTopMinus = scrollPos + 73;
			if (refElement.offsetTop <= scrollTopMinus && (refElement.offsetTop + refElement.offsetHeight > scrollTopMinus)) {
				document.querySelector('.page-scroll').classList.remove('active');
				currLink.classList.add('active');
			} else {
				currLink.classList.remove('active');
			}
		}
	};

	window.document.addEventListener('scroll', onScroll);


	//===== close navbar-collapse when a  clicked
	let navbarToggler = document.querySelector(".navbar-toggler");
	var navbarCollapse = document.querySelector(".navbar-collapse");

	document.querySelectorAll(".page-scroll").forEach(e =>
		e.addEventListener("click", () => {
			navbarToggler.classList.remove("active");
			navbarCollapse.classList.remove('show')
		})
	);
	navbarToggler.addEventListener('click', function () {
		navbarToggler.classList.toggle("active");
	})

	//======= tiny slider for slider-active
	tns({
		container: '.slider-active',
		items: 1,
		slideBy: 'page',
		autoplay: true,
		mouseDrag: true,
		gutter: 0,
		nav: true,
		controls: false,
		autoplayButtonOutput: false,
	});

	//======== tiny slider for testimonial
	tns({
		slideBy: 'page',
		autoplay: false,
		mouseDrag: true,
		gutter: 0,
		nav: true,
		controls: false,
		"container": "#customize",
		"items": 1,
		"center": true,
		"navContainer": "#customize-thumbnails",
		"navAsThumbnails": true,
		"autoplayTimeout": 5000,
		"swipeAngle": false,
		"speed": 400,
	});

	//======== WOW active
	new WOW().init();

	//======== tiny slider for team active
	tns({
		container: '.team-active',
		items: 4,
		slideBy: 'page',
		autoplay: false,
		mouseDrag: true,
		gutter: 15,
		nav: true,
		controls: false,
		responsive: {
			0: {
				items: 1,
			},
			768: {
				items: 2,
			},
			992: {
				items: 3,
			},
			1200: {
				items: 4,
			},
		}
	});


	//========= glightbox
	const myGallery = GLightbox({
		'href': 'https://www.youtube.com/watch?v=LXb3EKWsInQ',
		'type': 'video',
		'source': 'youtube', //vimeo, youtube or local
		'width': 900,
		'autoplayVideos': true,
	});

	//======== select js
	new Selectr('#doctor', {
		searchable: false,
		width: 300
	});
/*
	//======== datepicker 
	var picker = new Pikaday({
		field: document.getElementById('input_date')
	});
*/
})();	