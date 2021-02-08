<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- MyStyles -->
  <link rel="stylesheet" href="css/styles.css">
  <title><?= $PG_NAME ?></title>
  <style>
    @import 'https://fonts.googleapis.com/css?family=Rubik+Mono+One';

    .t-opacity:hover {
      border-radius: 15%;
      -webkit-border-radius: 15%;
      box-shadow: 0px 0px 15px 15px #ec731e;
      -webkit-box-shadow: 0px 0px 5px 5px #ec731e;
      transform: rotate(360deg);
      -webkit-transform: rotate(360deg);
    }

    .view,
    body,
    html {
      height: 100%
    }

    .header {
      background: url('images/dentist-with-smile.jpg') center -140px no-repeat;
      background-size: cover;
      height: 360px;
    }

    .navbar {
      background-color: rgba(0, 0, 0, .2);
      transition: all 1s ease;
    }

    .bg-inverse {
      background-color: white;
      box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);
    }

    .navbar-toggler {
      background-color: #fcf3fa;
    }

    .page-footer,
    .top-nav-collapse {
      background-color: #1C2331
    }

    @media only screen and (max-width:768px) {
      .navbar {
        background-color: white;
        /* #1C2331*/
      }

      .header {
        background-position: center bottom;
        background-size: 900px 100%;
        transition: all 1s ease;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {
      .navbar:not(.top-nav-collapse) {
        background-color: rgba(0, 0, 0, .2) !important;
      }
    }

    .text-shadow {
      text-shadow: 1px 1px 2px black;
    }

    .day-calendar:hover {
      background-color: rgba(0, 0, 0, .2) !important;
    }
  </style>
</head>