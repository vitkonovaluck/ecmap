<style>
.cssSlider {
	display: block;
	position: relative;
	width: 640px;
	overflow: hidden;
}
.cssSlider .slides {
	overflow: hidden;
	overflow: hidden;
	width: 640px ;
	height: 100%;
	margin: 0;
	padding: 0;
	list-style: none;
}
.cssSlider .slides > li {
	width: 640px;
	height: 100%;
	position: absolute;
	z-index: 1;
	overflow: hidden;
}
.cssSlider .slides > li > img {
	width: 640 px;
	height: auto;
}
/*
.cssSlider .slides > li:first-child:not(:target) {
	z-index: 1;
	-webkit-transform: translateY(0%);
	        transform: translateY(0%);
}
*/
.cssSlider .thumbnails {
	display: block;
	position: relative;
	padding: 0;
	margin: 0;
	list-style: none;
}
.cssSlider .thumbnails > li {
	float: left;
	width: 20%;
}
.cssSlider .thumbnails > li > a {
	display: block;
}
.cssSlider .thumbnails > li > a > img {
	width: 100%;
	height: auto;
}

.cssSlider .slides li:target {
	z-index: 3;
	-webkit-animation: slide 1s 1;
}
.cssSlider .slides li:not(:target) {
	-webkit-animation: hidden 1s 1;
}
@-webkit-keyframes slide {
	0% {
		-webkit-transform: translateX(-100%);
		        transform: translateX(-100%);
	}
	100% {
		-webkit-transform: translateX(0%);
		        transform: translateX(0%);
	}
}
@keyframes slide {
	0% {
		-webkit-transform: translateX(-100%);
		        transform: translateX(-100%);
	}
	100% {
		-webkit-transform: translateX(0%);
		        transform: translateX(0%);
	}
}
@-webkit-keyframes hidden {
	0% {
		z-index: 2;
		-webkit-transform: translateX(0%);
		        transform: translateX(0%);
	}
	100% {
		z-index: 2;
		-webkit-transform: translateX(100%);
		        transform: translateX(100%);
	}
}
@keyframes hidden {
	0% {
		z-index: 2;
		-webkit-transform: translateX(0%);
		        transform: translateX(0%);
	}
	100% {
		z-index: 2;
		-webkit-transform: translateX(100%);
		        transform: translateX(100%);
	}
}    
</style>
<center>
<div class="cssSlider">
    
        <ul class="thumbnails">
	 <?php $i = 1;?>            
            
        <?php foreach($photo as $pht):?>
		<li><a href="#slide<?php echo $i;?>"><?php echo $i; $i++;?></a></li>
	<?php endforeach; ?>
        </ul>
	<ul class="slides">
       <?php $i = 1;?>            
            
       <?php foreach($photo as $pht):?>
            <li id="slide<?php echo $i;?>"><img src="<?php echo $path ;?>../uploads/<?php echo $pht['jf_file']?>" alt="" width="640" /></li>
                <?php $i++;?>
        <?php endforeach; ?>

	</ul>
	
</div>
    </center>