<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">


	<style type="text/css">
    html, body, div, span, applet, object, iframe,
    h1, h2, h3, h4, h5, h6, p, blockquote, pre,
    a, abbr, acronym, address, big, cite, code,
    del, dfn, em, img, ins, kbd, q, s, samp,
    small, strike, strong, sub, sup, tt, var,
    b, u, i, center,
    dl, dt, dd, ol, ul, li,
    fieldset, form, label, legend,
    table, caption, tbody, tfoot, thead, tr, th, td,
    article, aside, canvas, details, embed,
    figure, figcaption, footer, header, hgroup,
    menu, nav, output, ruby, section, summary,
    time, mark, audio, video {
      margin: 0;
      padding: 0;
      border: 0;
      font-size: 100%;
      font: inherit;
      vertical-align: baseline;
    }

    article, aside, details, figcaption, figure,
    footer, header, hgroup, menu, nav, section {
      display: block;
    }

    body {
      line-height: 1;
    }

    ol, ul {
      list-style: none;
    }

    blockquote, q {
      quotes: none;
    }

    blockquote:before, blockquote:after,
    q:before, q:after {
      content: '';
      content: none;
    }

    table {
      border-collapse: collapse;
      border-spacing: 0;
    }

    body, html {
      font-size: 16px;
      font-family: 'Open Sans', sans-serif;
      background-color: #f5f5f5;
      text-align: center;
    }

    a, button {
      -webkit-transition: all 260ms ease-out;
      -moz-transition: all 260ms ease-out;
      -o-transition: all 260ms ease-out;
      transition: all 260ms ease-out;
    }

    div {
      width: 340px;
      padding: 20px 40px;
      display: inline-block;
      margin: 0 auto;
      background-color: white;
      margin-top: 200px;
      border: 1px solid rgba(0,0,0, .1);
      box-shadow: 0px 2px 4px rgba(0,0,0, .1);
      position: relative;
      z-index: 2;
      box-sizing: border-box;
    }

    form {
      display: block;
      float: left;
      width: 100%;
      position: relative;
    }

    form > * {
      width: 100%;
      float: left;
      display: block;
    }

    form input {
      padding: 1em 0;
    }

    form label {
      margin-bottom: 10px;
      margin-top: 20px;
      text-align: left;
    }

    form button {
      float: left;
      display: block;
      padding: 1em 0;
      border: none;
      font-size: 0.85em;
      font-weight: bold;
      text-transform: uppercase;
      margin-top: 20px;
      margin-bottom: 10px;
      color: white;
      background-color: #1369b0;
      cursor: pointer;
    }

    form button:hover {
      background-color: #133fb0;
    }
	</style>
</head>

<body>
  <section>
    <!-- FORM -->
    <div>
      <form class="" action="<?php echo site_url('welcome/login'); ?>" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" value="">
        <label for="password">Password:</label>
        <input type="password" name="password" value="">
        <button type="submit" name="">Login</button>
      </form>
      <?php if(function_exists('validation_errors')) {echo validation_errors();} ?>
    </div>
  </section>
</body>
</html>
