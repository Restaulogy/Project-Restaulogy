{literal}
<style type="text/css">
#page-wrap { width: 960px; margin: 60px auto; }
#page-wrap		#breadcrumb {
			list-style: none;
			overflow: hidden;
			font: 18px Helvetica, Arial, Sans-Serif;
		}
#page-wrap		#breadcrumb li {
			float: left;
		}
#page-wrap		#breadcrumb li a {
			color: white;
			text-decoration: none;
			padding: 10px 0 10px 55px;
			background: brown;                   /* fallback color */
			background: hsla(34,85%,35%,1);
			position: relative;
			display: block;
			float: left;
		}
#page-wrap		#breadcrumb li a:after {
			content: " ";
			display: block;
			width: 0;
			height: 0;
			border-top: 50px solid transparent;           /* Go big on the size, and let overflow hide */
			border-bottom: 50px solid transparent;
			border-left: 30px solid hsla(34,85%,35%,1);
			position: absolute;
			top: 50%;
			margin-top: -50px;
			left: 100%;
			z-index: 2;
		}
#page-wrap		#breadcrumb li a:before {
			content: " ";
			display: block;
			width: 0;
			height: 0;
			border-top: 50px solid transparent;           /* Go big on the size, and let overflow hide */
			border-bottom: 50px solid transparent;
			border-left: 30px solid white;
			position: absolute;
			top: 50%;
			margin-top: -50px;
			margin-left: 1px;
			left: 100%;
			z-index: 1;
		}
#page-wrap		#breadcrumb li:first-child a {
			padding-left: 10px;
		}
#page-wrap		#breadcrumb li:nth-child(2) a       { background:        hsla(34,85%,45%,1); }
#page-wrap		#breadcrumb li:nth-child(2) a:after { border-left-color: hsla(34,85%,45%,1); }
#page-wrap		#breadcrumb li:nth-child(3) a       { background:        hsla(34,85%,55%,1); }
#page-wrap	    #breadcrumb li:nth-child(3) a:after { border-left-color: hsla(34,85%,55%,1); }
#page-wrap		#breadcrumb li:nth-child(4) a       { background:        hsla(34,85%,65%,1); }
#page-wrap		#breadcrumb li:nth-child(4) a:after { border-left-color: hsla(34,85%,65%,1); }
#page-wrap		#breadcrumb li:nth-child(5) a       { background:        hsla(34,85%,75%,1); }
#page-wrap		#breadcrumb li:nth-child(5) a:after { border-left-color: hsla(34,85%,75%,1); }
#page-wrap		#breadcrumb li:last-child a {
			background: white !important;
			color: black;
			pointer-events: none;
 			cursor: default;
		}
#page-wrap #breadcrumb li:last-child a:after { border: 0; }
#page-wrap #breadcrumb li a:hover { background: hsla(34,85%,25%,1); }
#page-wrap		#breadcrumb li a:hover:after { border-left-color: hsla(34,85%,25%,1) !important; }

	</style>
{/literal}


	<div id="page-wrap">

		<h4>CSS Triangle Breadcrumbs</h4>

		<ul id="breadcrumb">
			<li><a href="#">Home</a></li>
			<li><a href="#">Vehicles</a></li>
			<li><a href="#">Vans</a></li>
			<li><a href="#">Camper Vans</a></li>
			<li><a href="#">1989 VW Westfalia Vanagon</a></li>
		</ul>

	</div>


