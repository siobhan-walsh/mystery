<?php
	include("head.php");
    include("header2.php");
    
?>
   
        
        <div class='content'>
        
            
           <h3 class='htitle'> Pick Your Character </h3>
                
            
        
        </div>

		<!--<script src='js/backbtn.js'></script>-->
        
        <script>
			$(document).ready(function(){
				

				
				//var add = document.querySelectorAll('.add');
				
				var content = document.querySelector('.content');
				
				var character = 'b';
				var characterstuff = [];
				var chid = '';
				var pendingarr = [];
				var acceptedarr = [];
				
				//global array for pending response characters
				
				//acceptedarr = [] global array for accepted response characters
				
				
				//if characterid is not in accepter array, AND is not in pending
				var frienddiv = document.createElement('div');
				var theight = $('.header').height();
				var bheight = $('.footer').height();
				var takenchinfo = [];
				
			
				frienddiv.id = 'frienddiv';
				//frienddiv.style.top = theight + 'px';
				frienddiv.style.width = '100%';
				frienddiv.style.height = '80vh';
				frienddiv.style.bottom = '0px';
				frienddiv.style.backgroundColor = 'rgba(255, 255, 255, 0.9)';
				frienddiv.style.zIndex = 1;
				frienddiv.style.boxShadow = "0px -2px 4px #666666";
				frienddiv.style.display = 'none';
				frienddiv.style.overflow = 'scroll';
				
				
				frienddiv.innerHTML = '';
				document.getElementById('header').appendChild(frienddiv);
				
				
				getcharacters();
				
				
				
				//first get the character info and push to the global array
				
				function getcharacters(){
				
					$.ajax({
						url:"server/character-server.php",
						type:"POST",
						dataType:"JSON",
						success:function(characterresp){
							
							
								//console.log('characterresp zero is', characterresp[0]);
								
								characterrespSize = objectSize(characterresp);
								
							
									characterstuff = characterresp[0];
									
								
								
								console.log('characterstuff is', characterstuff);
								
								
	/*--------------- show hosts character --------------------------*/
								hostscharacter();
				
								
								
								
						},
						error: function(jqXHR, textStatus, errorThrown) {
										
										console.log(jqXHR.statusText, textStatus, errorThrown);
										console.log('search error');
										  
									
								
						}
								
					});	
				
				};
				
				//then get the host's character info
				
				function hostscharacter(){
				
				$.ajax({
							url:"server/gamecheck.php",
							type:"POST",
							dataType:"JSON",
							data:{
								
								mode:'checkgame',
								
								
								},
							success:function(gcheck){
								
								
								
								console.log("gamecheck info returned: ", gcheck);
								
								console.log('this ch id is', gcheck['gamecheck'][0]['character_id']);
								
								chid = gcheck['gamecheck'][0]['character_id'];
								
								console.log('pushing chid', chid);
								pendingarr.push(chid);
								
								chindex = chid - 1;
								
								console.log("my character is", chid);	
											
											var charname = document.createElement('h3');
											charname.className = 'charname';
											charname.innerHTML = characterstuff[chindex]['character_name'];
											
											console.log('charname is', characterstuff[chindex]['character_name']);
											
											var charrow = document.createElement('div');
											charrow.className = 'charrow';
											
											var add = document.createElement('div');
											add.id = chid;
											add.className = 'add';
											
										
											var img = document.createElement('img');
											img.className = 'charimg';
											img.src = characterstuff[chindex]['character_img'];
											
											
											var checkimg = document.createElement('img');
											checkimg.className = 'plusimg';
											checkimg.src = 'img/circle_green.png';
											
											var span = document.createElement('span');
											span.style.color = '#000000';
											span.style.fontSize = '120%';
											span.innerHTML = "You are playing this character";
											
											var charcontent = document.createElement('div');
											charcontent.className = 'charcontent';
											charcontent.innerHTML = characterstuff[chindex]['character_description'];
											
											
											
											add.appendChild(checkimg);
											add.appendChild(span);
											
											
											
											charrow.appendChild(img);
											charrow.appendChild(add);
											charrow.appendChild(charcontent);
											
											content.appendChild(charname);
											content.appendChild(charrow);
	/*--------------- show accepted characters --------------------------*/
	
					acceptedusers();			
	
							},
							error: function(jqXHR, textStatus, errorThrown) {
									//console.log(jqXHR.statusText, textStatus, errorThrown);
									console.log('gcheck fail', jqXHR.statusText, textStatus);
							  
							}
							
						});	
					
					
					
						
				};
						
						
				function acceptedusers(){
				
					$.ajax({
							url:"server/accepcharcheck.php",
							type:"POST",
							dataType:"JSON",
							data:{
								
								mode:'checkgame',
								
								
								},
							success:function(accepchar){
								
								
								
								console.log("accepchar is returned: ", accepchar);
								
								
								accepcharinfo = accepchar.acceptinfo;
								
								accepcharSize = objectSize(accepcharinfo) 
								
								console.log('accepchar is', accepchar);
								
								for(var i = 0; i< accepcharSize; i++){
									
									console.log('this is an array right');
									
									pendingarr.push(accepcharinfo[i].accch);
									
									achnum = accepcharinfo[i].accch - 1;
									usname = accepcharinfo[i].accinfo;
									
									
									console.log('achnum is', achnum);
									
									
									
									var charname = document.createElement('h3');
											charname.className = 'charname';
											charname.innerHTML = characterstuff[achnum]['character_name'];
											
											var charrow = document.createElement('div');
											charrow.className = 'charrow';
											
											var add = document.createElement('div');
											add.id = accepcharinfo[i].accch;
											add.className = 'add';
											
										
											var img = document.createElement('img');
											img.className = 'charimg';
											img.src = characterstuff[achnum]['character_img'];
											
											
											
											var charcontent = document.createElement('div');
											charcontent.className = 'charcontent';
											charcontent.innerHTML = characterstuff[achnum]['character_description'];
											
											
											add.innerHTML = '<img class="plusimg" src ="img/circle_green.png"><span>' + usname +' has accepted this character</span>';
											
											
											
											charrow.appendChild(img);
											charrow.appendChild(add);
											charrow.appendChild(charcontent);
											
											content.appendChild(charname);
											content.appendChild(charrow);
											
									
								};
	
			/*--------------- show pending characters -------*/
								otheruserscharacters();	
								
							},
							error: function(jqXHR, textStatus, errorThrown) {
									//console.log(jqXHR.statusText, textStatus, errorThrown);
									console.log('accepchar fail', jqXHR.statusText, textStatus);
							  
							}
							
						});	
						
						
						
				};
						
					//then show the characters that have already been assigned to a user	
					
				function otheruserscharacters(){
				
					$.ajax({
							url:"server/gamecharcheck.php",
							type:"POST",
							dataType:"JSON",
							data:{
								
								mode:'checkgame',
								
								
								},
							success:function(gamecharcheck){
								
								
								
								console.log("gamecharcheck info returned: ", gamecharcheck);
								
								takenchinfo = gamecharcheck.takeninfo;
								
								takenchinfoSize = objectSize(takenchinfo) 
								
								console.log('takenchinfo is', takenchinfo);
								
								for(var i = 0; i< takenchinfoSize; i++){
									
									console.log('this is an array right');
									
									pendingarr.push(takenchinfo[i].takench);
									
									chnum = takenchinfo[i].takench - 1;
									usname = takenchinfo[i].takeninfo;
									
									
									console.log('chnum is', chnum);
									
									
									
									var charname = document.createElement('h3');
											charname.className = 'charname';
											charname.innerHTML = characterstuff[chnum]['character_name'];
											
											var charrow = document.createElement('div');
											charrow.className = 'charrow';
											
											var add = document.createElement('div');
											add.id = chid;
											add.className = 'add';
											
										
											var img = document.createElement('img');
											img.className = 'charimg';
											img.src = characterstuff[chnum]['character_img'];
											
											
											
											var charcontent = document.createElement('div');
											charcontent.className = 'charcontent';
											charcontent.innerHTML = characterstuff[chnum]['character_description'];
											
											
											add.innerHTML = '<img class="plusimg" src ="img/circle_purple.png"><span>You invited ' + usname +', their response is pending</span>';
											
											
											
											charrow.appendChild(img);
											charrow.appendChild(add);
											charrow.appendChild(charcontent);
											
											content.appendChild(charname);
											content.appendChild(charrow);
											
									
								};
	
								unassignedCharacters();
							},
							error: function(jqXHR, textStatus, errorThrown) {
									//console.log(jqXHR.statusText, textStatus, errorThrown);
									console.log('gcheck fail', jqXHR.statusText, textStatus);
							  
							}
							
						});	
						
						
						
				};
				
				function unassignedCharacters(){
						console.log('characterstuff is a thing', characterstuff);
						
						characterstuffSize = objectSize(characterstuff);
						
						
						
						
						var takenresult = (jQuery.inArray('4', pendingarr));
						
						console.log('is 4 in the array', takenresult);
						
						for(var i = 0; i < characterstuffSize; i++){
							
							
							if(jQuery.inArray(characterstuff[i]['character_id'], pendingarr) == -1){
								
								console.log('these characters are free', characterstuff[i]['character_id']);
								
								
								
											var charname = document.createElement('h3');
											charname.className = 'charname';
											charname.innerHTML = characterstuff[i]['character_name']
											
											var charrow = document.createElement('div');
											charrow.className = 'charrow';
											
											var img = document.createElement('img');
											img.className = 'charimg';
											img.src = characterstuff[i]['character_img'];
											
											var add = document.createElement('div');
											add.className = 'add';
											add.id = characterstuff[i]['character_id'];
											add.addEventListener("click", blindClick(i));
											
											var plusimg = document.createElement('img');
											plusimg.className = 'plusimg';
											plusimg.src = 'img/plusbutton.png';
											
											var span = document.createElement('span');
											span.innerHTML = "assign character";
											
											var charcontent = document.createElement('div');
											charcontent.className = 'charcontent';
											charcontent.innerHTML = characterstuff[i]['character_description'];
											
											console.log('img src is', characterstuff[i]['character_img']);
											
											
											
											add.appendChild(plusimg);
											add.appendChild(span);
											
											
											
											charrow.appendChild(img);
											charrow.appendChild(add);
											charrow.appendChild(charcontent);
											
											content.appendChild(charname);
											content.appendChild(charrow);
								
								
								
								
								
								
								
							} else if(jQuery.inArray(characterstuff[i]['character_id'], pendingarr) == 0){
								
								console.log('these characters are not free', characterstuff[i]['character_id']);
								
							}
							
							
						};
					bbtn();	
				};
						
			function blindClick(i) {	
				 return function(){
				
					console.log('assigning character to firend');
					content.style.filter = 'blur(1px)';
					
					//put assigning character functionality here
					
					var character_id = this.id;
							
							console.log('character_id is', character_id);
			
							var inp = document.createElement('input');
							var searchbtn = document.createElement('button');
							var br = document.createElement('br');
							var cprow = document.createElement('div');
							var btnrow = document.createElement('div');
                            var canvas = document.createElement('canvas');
                            var context = canvas.getContext('2d');
							var cancel = document.createElement('button');
							
							cprow.id = 'cprow';
                            document.body.appendChild(cprow);
							
							btnrow.appendChild(inp);
							btnrow.appendChild(searchbtn);
							btnrow.appendChild(cancel);
							
							cprow.appendChild(btnrow);
                            cprow.appendChild(canvas);
							
                            
                            console.log(canvas,cprow,inp);
                            
                            
							
                     
                            cprow.style.margin='0';
                            cprow.style.padding='0';
							cprow.style.width = '100%';
							cprow.style.height = '100%';
							
                            //canvas.style.position='absolute';
                            canvas.style.padding='0';
                            canvas.style.width='100%';
                            canvas.style.height='100%';
							
                           
                            inp.style.width='80%';
                            inp.style.height='5%';
                            inp.style.margin='4% 10%';
                            
                            inp.style.outline='none';
                            inp.style.backgroundColor='rgba(255,255,255,0.3)';
                            inp.style.border='2px solid #fff';
                            inp.style.borderRadius='3px';
                            inp.style.fontWeight='300';
                            inp.style.fontSize='18pt';
                            inp.style.letterSpacing='2px';
                         
							searchbtn.style.marginLeft = '10%';
							cancel.style.float = 'right';
							
                            btnrow.style.position='absolute';
							btnrow.style.width = '100%';
							btnrow.style.zIndex = '1';
                           // searchbtn.style.left='60%';
                         
							
                            var grd, 
                                keys_down = [], 
                                letters = [];
                      
                            var symbols = [{k:81,s:"q",x:5},{k:87,s:"w",x:15},{k:69,s:"e",x:25},{k:82,s:"r",x:35},{k:84,s:"t",x:45},{k:89,s:"y",x:55},{k:85,s:"u",x:65},{k:73,s:"i",x:75},{k:79,s:"o",x:85},{k:80,s:"p",x:95},{k:65,s:"a",x:10},{k:83,s:"s",x:20},{k:68,s:"d",x:30},{k:70,s:"f",x:40},{k:71,s:"g",x:50},{k:72,s:"h",x:60},{k:74,s:"j",x:70},{k:75,s:"k",x:80},{k:76,s:"l",x:90},{k:90,s:"z",x:20},{k:88,s:"x",x:30},{k:67,s:"c",x:40},{k:86,s:"v",x:50},{k:66,s:"b",x:60},{k:78,s:"n",x:70},{k:77,s:"m",x:80},{k:48,s:"0",x:90},{k:49,s:"1",x:0},{k:50,s:"2",x:10},{k:51,s:"3",x:20},{k:52,s:"4",x:30},{k:53,s:"5",x:40},{k:54,s:"6",x:50},{k:55,s:"7",x:60},{k:56,s:"8",x:70},{k:57,s:"9",x:80}];
                      
                            function Letter (key){
                                this.x = findX(key);
                                this.symbol = findS(key);
                                this.color = "rgba(255, 255, 255, "+Math.random()+")";
                                this.size = Math.floor((Math.random()*40)+12);
                                this.path = getRandomPath(this.x);
                                this.rotate = Math.floor((Math.random() * Math.PI) + 1);
                                this.percent = 0;
                            }
                            
                            Letter.prototype.draw = function(){
                                var percent = this.percent/100;
                                var xy = getQuadraticBezierXYatPercent(this.path[0],this.path[1],this.path[2],percent);
                                context.save();
                                context.translate(xy.x,xy.y);
                                context.rotate(this.rotate);
                                context.font = this.size+"px Arial";
                                context.fillStyle = this.color;
                                context.fillText(this.symbol, -15, -15);
                                context.restore();
                            };
                      
                            Letter.prototype.drawPath = function(){
                                context.lineWidth = 1;
                                context.beginPath();
                                context.moveTo(this.path[0].x, this.path[0].y);
                                context.quadraticCurveTo(this.path[1].x, this.path[1].y, this.path[2].x, this.path[2].y);
                                context.stroke();
                            }
                            
                            function findX(key){
                                
                                for (var i=0; i<symbols.length; i++){
                                    if(symbols[i].k==key){
                                        return(symbols[i].x * canvas.width / 100);
                                    }
                                };
                                return false;
                            }
                      
                            function findS(key){
                                for(var i = 0; i<symbols.length; i++){
                                    if(symbols[i].k == key){
                                        return symbols[i].s;
                                    }
                                };
                                return false;
                            }
                      
                            function getRandomPath(x){
                                var x_start = x;
                                var x_end = x_start + Math.floor((Math.random()*400)-199);
                                return [{ x:x_start,
                                          y:canvas.height},
                                        { x:(x_start + x_end)/2,
                                          y: Math.floor((Math.random()*canvas.height)-canvas.height)},
                                        { x:x_end,
                                          y:canvas.height}];
                            
                            }
                     
                            function drawBackground(){
                                context.fillStyle = grd;
                                context.fillRect(0, 0, canvas.width, canvas.height);
                            }
                            
                            function getLineXYatPercent(startPt,endPt,percent){
                                var dx = endPt.x - startPt.x;
                                var dy = endPt.y - startPt.y;
                                var X = startPt.x + dx*percent;
                                var Y = startPt.y + dy*percent;
                                return({x:X, y:Y});
                            }
                            
                            function getQuadraticBezierXYatPercent(startPt, controlPt, endPt, percent){
                                var x = Math.pow(1-percent,2)*startPt.x + 2*(1-percent) * percent * controlPt.x + Math.pow(percent,2)*endPt.x;
                                var y = Math.pow(1-percent,2)*startPt.y + 2*(1-percent) * percent * controlPt.y + Math.pow(percent,2)*endPt.y;
                                return({x:x, y:y});
                            }
                     
                            function getCubicBezierXYatPercent(startPt, controlPt1, controlPt2, endPt, percent){
                                var x = CubicN(percent,startPt.x,controlPt1.x,controlPt2.x,endPt.x);
	var y = CubicN(percent,startPt.y,controlPt1.y,controlPt2.y,endPt.y);
	return ({x:x,y:y});
}

function CubicN(pct, a,b,c,d) {
	var t2 = pct * pct;
	var t3 = t2 * pct;
	return a + (-a * 3 + pct * (3 * a - a * pct)) * pct
	+ (3 * b + pct * (-6 * b + b * 3 * pct)) * pct
	+ (c * 3 - c * 3 * pct) * t2
	+ d * t3;
}

function resize() {
	var box = canvas.getBoundingClientRect();
	canvas.width = box.width;
	canvas.height = box.height;
	grd = context.createRadialGradient(canvas.width/2, canvas.height/2, 0, canvas.width/2, canvas.height/2, canvas.height);
	grd.addColorStop(0,"grey");
	grd.addColorStop(1,"lightgrey");
}

function draw() {
	context.clearRect(0,0,canvas.width,canvas.height);
	drawBackground();

	for (var i = 0; i < letters.length; i++) {
		letters[i].percent += 1;
		letters[i].draw();
		// letters[i].drawPath();
		if(letters[i].percent > 100){
			letters.splice(i, 1);
		}
	};

	for (var i = 0; i < keys_down.length; i++) {
		if(keys_down[i]){
			letters.push(new Letter(i));
		}
	};
	requestAnimationFrame(draw);
}
var start_keys = [81,87,69,82,84,89,85,73,79,80];

function startAnimation(){
	setTimeout(function(){
		var key = start_keys.pop();
		keys_down[key] = true;
		setTimeout(function(){
			keys_down[key] = false;
		},180);
		if(start_keys.length > 0){
			startAnimation();
		}
	}, 180);
}
resize();
draw();
startAnimation();

window.onresize = resize;

inp.onkeyup = function(event){
	keys_down[event.keyCode] = false;
}

inp.onkeydown = function(event){
  if(event.keyCode == 91 && event.keyCode == 224){
    keys_down = [];
  }
	else if(event.keyCode >= 65 && event.keyCode <= 90 || event.keyCode >= 48 && event.keyCode <= 57){
		keys_down[event.keyCode] = true;
	}
}

inp.focus();

window.requestAnimationFrame = (function(){
    return  window.requestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame ||
            window.oRequestAnimationFrame ||
            window.msRequestAnimationFrame ||
            function (callback) {
                window.setTimeout(callback, 1000 / 60);
            };
})();
      

							
							
							searchbtn.id = 'searchbtn';
							searchbtn.innerHTML = 'search';
							searchbtn.className = 'whitebtn';
							searchbtn.style.backgroundColor = '#27A5A1';
                            searchbtn.style.color= 'white';
							searchbtn.style.marginRight = '10%';

							
							
							
							
							var resultsdiv = document.createElement('div');

							console.log(resultsdiv,frienddiv);
							cancel.innerHTML = 'cancel';
							cancel.style.backgroundColor = '#27A5A1';
							cancel.style.color = 'white';
							cancel.className = 'whitebtn';
				            cancel.style.position='absolute';
							

							
							frienddiv.appendChild(cprow);
							frienddiv.style.display = 'block';
							
							
							document.getElementById('header').appendChild(frienddiv);
							
							cancel.onclick = function(){
								frienddiv.style.display = 'none';
								frienddiv.innerHTML = '';	
								content.style.filter = 'none';
						
							};
						
							
					
						
						searchbtn.onclick = function(){
							
							
							
							resultsdiv.innerHTML = '';
							
							$.ajax({
							url:"server/friends-server.php",
							type:"POST",
							dataType:"JSON",
							data:{
								
								
								term:inp.value
								
								
								},
							success:function(sresp){
								
								console.log("sresp:", sresp);	
								
								if(sresp == 'sorry'){
									
									resultsdiv.innerHTML = "Sorry, there are no users with that email";
									//frienddiv.appendChild(resultsdiv);
									
								} else {
									
									
										
										var img = document.createElement('img');	
										var p = document.createElement('p');
										var addbtn = document.createElement('button');
										
										var resultsun = sresp.username;
										var resultsavi = sresp.avatar;
										var resultsuid = sresp.uid;
										//addbtn.style.position='absolute';
										addbtn.className = 'whitebtn';
										addbtn.style.margin = '0 30%';
                                        inp.placeholder = 'search by user email';
							            inp.id = 'searchinp';
										addbtn.innerHTML = "Invite to play";
										addbtn.style.backgroundColor='#27A5A1';
										addbtn.style.color='white';
            
										img.src = resultsavi;
										img.style.width = '30%';
										img.style.margin = '4% 35%';
										p.innerHTML = resultsun;
										p.style.width = '100%';
										p.style.textAlign = 'center';
										
										
										resultsdiv.style.padding = '4%';
										btnrow.appendChild(img);
										btnrow.appendChild(p);
										btnrow.appendChild(addbtn);
                                        resultsdiv.style.position='absolute';
										
										
										addbtn.onclick = function(){
											
											console.log('sending request');
											console.log('this character is', character_id);
											addbtn.style.backgroundColor = '#e3e3e3';
											
                                            
                                            
										
                                        $.ajax({
				                                 url:"server/invite-server.php",
							                     type:"POST",
							                     dataType:"JSON",
							                     data:{
													 character_id: character_id,
													 frienduid: resultsuid
													 
								                    },
											 	success:function(respInv){
                                                 	console.log("game table", respInv);	
													
													if(respInv == 'unavailable'){
														resultsdiv.innerHTML = "Sorry, that user is unavailable";
													} else if(respInv == 'invited'){
													
														var thisdiv = document.getElementById(character_id);
														
														thisdiv.innerHTML = '<img class="plusimg" src ="img/circle_purple.png"><span>You invited ' + resultsun +', their response is pending</span>';
														
														content.style.filter = 'none';
														frienddiv.innerHTML = '';
														frienddiv.style.display = 'none';
													};
													
											 	},
											 	error: function(jqXHR, textStatus, errorThrown) {
								
													console.log(jqXHR.statusText, textStatus, errorThrown);
													console.log('search error');
												  
											
										
												}

										});
										
										
										
									
									};
									
								};
								
							
							},
							error: function(jqXHR, textStatus, errorThrown) {
								
								console.log(jqXHR.statusText, textStatus, errorThrown);
								console.log('search error');
								  
							
						
								}
							
							});	
							
					};
						
				 };
			};
				function objectSize(the_object) {
							  /* function to validate the existence of each key in the object to get the number of valid keys. */
					  var object_size = 0;
					  for (key in the_object){
						if (the_object.hasOwnProperty(key)) {
						  object_size++;
						}
					  }
					  return object_size;
				};
  
				
            	  
		
				function bbtn(){	 
					var bigbtn = document.createElement('button');
					var deletebtn = document.createElement('button');
					var bigbtndiv = document.createElement('div');
					
					
					var clicked = false;
					
					bigbtndiv.id = 'bigbtndiv';
					bigbtndiv.style.width = '100%';
					bigbtndiv.style.float = 'left';
					
				
					bigbtn.innerHTML = "Begin Game";
					bigbtn.style.textTransform = 'uppercase';
					bigbtn.style.borderColor = 'rgba(0,0,0,0.3)';
					bigbtn.style.textShadow = '0 1px 0 rgba(0,0,0,0.5)';
					bigbtn.style.width = '96%';
					bigbtn.style.padding = '3% 0%';
					bigbtn.style.color = '#FFF';
					bigbtn.style.borderRadius = '5px';
					bigbtn.style.margin = '4% 2% ';
					bigbtn.style.fontSize = '100%';
					bigbtn.style.backgroundColor = '#27A5A1';
					bigbtn.style.textAlign = 'center';
					bigbtn.style.letterSpacing = '2px';
					
					bigbtndiv.appendChild(bigbtn);
					
					deletebtn.innerHTML = "End Game";
					deletebtn.style.textTransform = 'uppercase';
					deletebtn.style.borderColor = 'rgba(0,0,0,0.3)';
					deletebtn.style.textShadow = '0 1px 0 rgba(0,0,0,0.5)';
					deletebtn.style.width = '96%';
					
					deletebtn.style.padding = '3% 0%';
					deletebtn.style.color = '#FFF';
					deletebtn.style.borderRadius = '5px';
					deletebtn.style.margin = '4% 2% ';
					deletebtn.style.fontSize = '100%';
					deletebtn.style.backgroundColor = '#c13232';
					deletebtn.style.textAlign = 'center';
					deletebtn.style.letterSpacing = '2px';
					
					bigbtndiv.appendChild(deletebtn);
					
					$(content).after( bigbtndiv );
					//content.appendChild(bigbtn);
					
				
					bigbtn.onclick = function(){
						
						
							//send host_id (user_id);
							
							
							 $.ajax({
								 url:"server/begin.php",
								 type:"POST",
								 dataType:"JSON",
								 data:{
									 startgame:'startgame'
									},
								success:function(begin){
									console.log('begin is', begin);
									
									window.location = 'direction.php';
									
									//update all the players to stage 5
							
								//"UPDATE game SET stage = 5 WHERE host_id= host_id;
								
									//then update the host to stage 4
											
								//UPDATE game SET stage = 4 WHERE player_id = host_id;
									
									//on success redirect to rounds page
									
								},
								error: function(jqXHR, textStatus, errorThrown) {
				
									console.log(jqXHR.statusText, textStatus, errorThrown);
									console.log('begin error');
								  
							
						
								}
	
						});
							
							
							
							
							
							
					};
					
					
					deletebtn.onclick = function(){
						
						
							//are you sure?
							
							var surediv = document.createElement('div');
							var surebtn = document.createElement('button');
							var nobtn = document.createElement('button');
							
							frienddiv.style.display = 'block';
							
							
							surediv.style.margin = '10%';
							surediv.style.width = '80%';
							surediv.innerHTML = 'Are you sure you would like to end this game?';
							
							surebtn.innerHTML = 'Yes end game';
							surebtn.style.textTransform = 'uppercase';
							surebtn.style.borderColor = 'rgba(0,0,0,0.3)';
							surebtn.style.textShadow = '0 1px 0 rgba(0,0,0,0.5)';
							surebtn.style.width = '96%';
							surebtn.style.padding = '3% 0%';
							surebtn.style.color = '#FFF';
							surebtn.style.borderRadius = '5px';
							surebtn.style.margin = '4% 2% ';
							surebtn.style.fontSize = '100%';
							surebtn.style.backgroundColor = '#c13232';
							surebtn.style.textAlign = 'center';
							
							
							nobtn.innerHTML = 'no back to game';
						
							nobtn.style.textTransform = 'uppercase';
							nobtn.style.borderColor = 'rgba(0,0,0,0.3)';
							nobtn.style.textShadow = '0 1px 0 rgba(0,0,0,0.5)';
							nobtn.style.width = '96%';
							
							nobtn.style.padding = '3% 0%';
							nobtn.style.color = '#FFF';
							nobtn.style.borderRadius = '5px';
							nobtn.style.margin = '4% 2% ';
							nobtn.style.fontSize = '100%';
							nobtn.style.backgroundColor = '#27A5A1';
							nobtn.style.textAlign = 'center';
							
							
							
							
							frienddiv.appendChild(surediv);
							frienddiv.appendChild(nobtn);
							frienddiv.appendChild(surebtn);
							
							
							nobtn.onclick = function(){
								
								frienddiv.innerHTML = '';
								frienddiv.style.display = 'none';
								
							};
							
							surebtn.onclick = function(){
							
							
								 $.ajax({
									 url:"server/endgame.php",
									 type:"POST",
									 dataType:"JSON",
									 
									success:function(ended){
										console.log('ended is', ended);
										
										window.location = 'direction.php';
										
									},
									error: function(jqXHR, textStatus, errorThrown) {
					
										console.log(jqXHR.statusText, textStatus, errorThrown);
										console.log('ended error');
									  
								
							
									}
		
							});
							
							
						
							
							};
							
					};
					
					
				};
				
				
			});
		</script>
        
        <?php 
        	include("footer.php");
        ?>
        
