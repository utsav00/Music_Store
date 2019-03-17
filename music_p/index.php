<?php
    session_start();
    $_SESSION["s_no"]=1;
?>

<!DOCTYPE html>
<html>
<head>
    <!-- this will help in opening in mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>



    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

        
    <!--slider-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/13.1.1/nouislider.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/13.1.1/nouislider.min.js"></script>

    <style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Laila:b);
        @import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:Semi-Bold);
        @import url(https://fonts.googleapis.com/css?family=PT+Serif:Bold);
        
        *{
            box-sizing: border-box;
        }

        body{
            background-color: black;
        }
        .col-xs-12.header div{
            height: 7em;
        }
        .col-xs-12.content div{
            
            overflow: hidden;
        }
        
        .col-xs-12.player{
            height: 10em;
            position: fixed;
            bottom: 0px;
            left:0px;
            display: flex;
            align-items: center;
            justify-content: center;
            /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#d2ff52+0,91e842+100;Neon */
            /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#e4efc0+0,abbd73+100;Olive+3D+%232 */
            background: #e4efc0; /* Old browsers */
            background: -moz-linear-gradient(top, #e4efc0 0%, #abbd73 100%); /* FF3.6-15 */
            background: -webkit-linear-gradient(top, #e4efc0 0%,#abbd73 100%); /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(to bottom, #e4efc0 0%,#abbd73 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e4efc0', endColorstr='#abbd73',GradientType=0 ); /* IE6-9 */
        }

        .row.content{
            display: flex;
            align-items: stretch;
        }


        .row.header{
            background-color: #00004d;
        }

        
        .col-xs-2.logo,.col-xs-6.qoute,.col-xs-4.log_button{
            display:flex;
            align-items: center;

        }
        .col-xs-6.qoute{
            justify-content: center;
        }
        .col-xs-4.log_button{
            justify-content: flex-end;
        }
        
        .btn.btn-outline-primary{
            font-weight: 600;
            color:  #0066ff;
            border-color: #0066ff;
            background-color: white;
        }
        .btn.btn-outline-primary:hover{
            font-weight: 600;
            color: #ffffff;
            background-color:  #0066ff;
        }


        

        .row.player_row{
            height: 100%;
            width: 100%;
            display:flex;
            align-items: center;
        }
        .col-xs-3.song_details{
            display:flex;
            align-items: center;
            font-family: PT Serif;

        }
        
        .row.left_player_content{
            display:flex;
            align-items: center;   
        }



        .row.time_bar{
            font-family: PT Serif, "sans serif"
            font-size: 1.5em;
            font-weight: bold; 
        }
        #slider-handles{
            margin-right: 1px;
            margin-left: 1px;
        }


        .row.basic_control{
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 6px;
        }
        .col-xs-2.shuffle,.col-xs-2.previous,.col-xs-2.play,.col-xs-2.next,.col-xs-2.repeat{
            display: flex;
            align-items: center;
            justify-content: center;   
        }
        input:active{
            box-shadow: 5px 5px 3px #888888;
        }
        
        
        


    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.1.1/howler.min.js"></script>
    <script>
        var Player = function(playlist) {
        this.playlist = playlist;
        this.index = 0;
        //this.playing=false;

        // Setup the playlist display.

      };
      Player.prototype = {
        /**
         * Play a song in the playlist.
         * @param  {Number} index Index of the song in the playlist (leave empty to play the first or current).
         */
        play: function(index) {
          var self = this;
          var sound;
          

          index = typeof index === 'number' ? index : self.index;
          var data = self.playlist[index];

          // If we already loaded this track, use the current one.
          // Otherwise, setup and load a new Howl.
          if (data.howl) {
            sound = data.howl;
          } else {
            sound = data.howl = new Howl({
              src: ['Music/' + data.file + '.mp3'],
              html5: true, // Force to HTML5 so that the audio can stream in (best for large files).
              onplay: function() {
                // Display the duration.
                end_time.innerHTML = self.formatTime(Math.round(sound.duration()));
                document.getElementById("songname").innerHTML="Song: "+s_n[self.index];
                document.getElementById("songartist").innerHTML="Song Artist: "+s_a[self.index];
                document.getElementById("songicon").innerHTML='<img src="Image/'+s_i[self.index]+".jpg"+'" class="img-thumbnail rounded mx-auto d-block" name="song_icon" width="100em" height="100em">';
                // Start upating the progress of the track.
                //requestAnimationFrame(self.step.bind(self));
                
                // Start the wave animation if we have already loaded
                //wave.container.style.display = 'block';
                //bar.style.display = 'none';
                //pauseBtn.style.display = 'block';
          //      playing=true;
              },
              onload: function() {
                // Start the wave animation.
                totalSeconds=0;
              },
              onend: function() {
                // Stop the wave animation.
                totalSeconds=0;
                self.skip('next');
              },
              onpause: function() {
                // Stop the wave animation.
            //    playing=false;
              },
              onstop: function() {
                // Stop the wave animation.
              //  playing=false;
              },
              onseek: function() {
                // Start upating the progress of the track.

              }
            });
          }

          // Begin playing the sound.
          sound.play();

          // Update the track display.
          //track.innerHTML = (index + 1) + '. ' + data.title;

          // Show the pause button.
          

          // Keep track of the index we are currently playing.
          self.index = index;
        },

        /**
         * Pause the currently playing track.
         */
        pause: function() {
          var self = this;

          // Get the Howl we want to manipulate.
          var sound = self.playlist[self.index].howl;

          // Puase the sound.
          sound.pause();

          // Show the play button.
          //playBtn.style.display = 'block';
          //pauseBtn.style.display = 'none';
        },

        /**
         * Skip to the next or previous track.
         * @param  {String} direction 'next' or 'prev'.
         */
        skip: function(direction) {
          var self = this;

          // Get the next track based on the direction of the track.
          var index = 0;
          if (direction === 'prev') {
            index = self.index - 1;
            if (index < 0) {
              index = self.playlist.length - 1;
            }
          } else {
            index = self.index + 1;
            if (index >= self.playlist.length) {
              index = 0;
            }
          }

          self.skipTo(index);
        },

        /**
         * Skip to a specific track based on its playlist index.
         * @param  {Number} index Index in the playlist.
         */
        skipTo: function(index) {
          var self = this;

          // Stop the current track.
          if (self.playlist[self.index].howl) {
            self.playlist[self.index].howl.stop();
          }

          // Reset progress.
          
          // Play the new track.
          self.play(index);
        },

//        /**
//         * Set the volume and update the volume slider display.
//         * @param  {Number} val Volume between 0 and 1.
//         */
        volume: function(val) {
          var self = this;

          // Update the global volume (affecting all Howls).
          Howler.volume(val);

          // Update the display on the slider.
          
        },
//
//        /**
//         * Seek to a new position in the currently playing track.
//         * @param  {Number} per Percentage through the song to skip.
//         */
        seek: function(per) {
          var self = this;

          // Get the Howl we want to manipulate.
          var sound = self.playlist[self.index].howl;
          timer.innerHTML = self.formatTime(Math.round(sound.seek()));
          // Convert the percent into a seek position.
          if (sound.playing()) {
            sound.seek(sound.duration() * per);
          }
            
        },
        sound: function(){
                var self = this;
                var soun=self.playlist[self.index].howl;
                return soun;
        },
        
        /**
         * The step called within requestAnimationFrame to update the playback position.
         */
//        step: function() {
//          var self = this;
//
//          // Get the Howl we want to manipulate.
//          var sound = self.playlist[self.index].howl;
//
//          // Determine our current seek position.
//          var seek = sound.seek() || 0;
//          timer.innerHTML = self.formatTime(Math.round(seek));
//          //progress.style.width = (((seek / sound.duration()) * 100) || 0) + '%';
//
//          // If the sound is still playing, continue stepping.
//          if (sound.playing()) {
//            requestAnimationFrame(self.step.bind(self));
//          }
//        },
//
//        /**
//         * Toggle the playlist display on/off.
//         */
//        togglePlaylist: function() {
//          var self = this;
//          var display = (playlist.style.display === 'block') ? 'none' : 'block';
//
//          setTimeout(function() {
//            playlist.style.display = display;
//          }, (display === 'block') ? 0 : 500);
//          playlist.className = (display === 'block') ? 'fadein' : 'fadeout';
//        },
//
//        /**
//         * Toggle the volume display on/off.
//         */
//        toggleVolume: function() {
//          var self = this;
//          var display = (volume.style.display === 'block') ? 'none' : 'block';
//
//          setTimeout(function() {
//            volume.style.display = display;
//          }, (display === 'block') ? 0 : 500);
//          volume.className = (display === 'block') ? 'fadein' : 'fadeout';
//        },
//
//        /**
//         * Format the time from seconds to M:SS.
//         * @param  {Number} secs Seconds to format.
//         * @return {String}      Formatted time.
//         */
        formatTime: function(secs) {
          var minutes = Math.floor(secs / 60) || 0;
          var seconds = (secs - minutes * 60) || 0;

          return minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
        }
      };
        
            

      // Bind our player controls.
//      play.addEventListener('click', function() {
//        player.play();
//      });
//      pause.addEventListener('click', function() {
//        player.pause();
//      });
//      previous.addEventListener('click', function() {
//        player.skip('prev');
//      });
//      next.addEventListener('click', function() {
//        player.skip('next');
//      });
//      waveform.addEventListener('click', function(event) {
//        player.seek(event.clientX / window.innerWidth);
//      });
//      playlistBtn.addEventListener('click', function() {
//        player.togglePlaylist();
//      });
//      playlist.addEventListener('click', function() {
//        player.togglePlaylist();
//      });
//      volumeBtn.addEventListener('click', function() {
//        player.toggleVolume();
//      });
//      volume.addEventListener('click', function() {
//        player.toggleVolume();
//      });
//
//      // Setup the event listeners to enable dragging of volume slider.
//      barEmpty.addEventListener('click', function(event) {
//        var per = event.layerX / parseFloat(barEmpty.scrollWidth);
//        player.volume(per);
//      });
//      sliderBtn.addEventListener('mousedown', function() {
//        window.sliderDown = true;
//      });
//      sliderBtn.addEventListener('touchstart', function() {
//        window.sliderDown = true;
//      });
//      volume.addEventListener('mouseup', function() {
//        window.sliderDown = false;
//      });
//      volume.addEventListener('touchend', function() {
//        window.sliderDown = false;
//      });

//      var move = function(event) {
//        if (window.sliderDown) {
//          var x = event.clientX || event.touches[0].clientX;
//          var startX = window.innerWidth * 0.05;
//          var layerX = x - startX;
//          var per = Math.min(1, Math.max(0, layerX / parseFloat(barEmpty.scrollWidth)));
//          player.volume(per);
//        }
//      };
//
//      volume.addEventListener('mousemove', move);
//      volume.addEventListener('touchmove', move);
//
//      // Setup the "waveform" animation.
//      var wave = new SiriWave({
//        container: waveform,
//        width: window.innerWidth,
//        height: window.innerHeight * 0.3,
//        cover: true,
//        speed: 0.03,
//        amplitude: 0.7,
//        frequency: 2
//      });
//      wave.start();
//
//      // Update the height of the wave animation.
//      // These are basically some hacks to get SiriWave.js to do what we want.
//      var resize = function() {
//        var height = window.innerHeight * 0.3;
//        var width = window.innerWidth;
//        wave.height = height;
//        wave.height_2 = height / 2;
//        wave.MAX = wave.height_2 - 4;
//        wave.width = width;
//        wave.width_2 = width / 2;
//        wave.width_4 = width / 4;
//        wave.canvas.height = height;
//        wave.canvas.width = width;
//        wave.container.style.margin = -(height / 2) + 'px auto';
//
//        // Update the position of the slider.
//        var sound = player.playlist[player.index].howl;
//        if (sound) {
//          var vol = sound.volume();
//          var barWidth = (vol * 0.9);
//          sliderBtn.style.left = (window.innerWidth * barWidth + window.innerWidth * 0.05 - 25) + 'px';
//        }
//      };
//      window.addEventListener('resize', resize);
//      resize();
    </script>
    

</head>
<body>
    
    <div class="container-fluid">
        <div class="row">

            <!--header-->
            <div class="col-xs-12 header">
                <div class="row header">
                    <div class="col-xs-2 logo" >
                        <img src="Image/logo.jpg" height="80px" width="80px">
                    </div>
                    <div class="col-xs-6 qoute" >
                        <h4 style="font-family: Laila; color:  #ffb3ff">"Music is an out-burst of the soul" -Muktan</h4>
                    </div>
                    <div class="col-xs-4 log_button">
                        <input type="button" class="btn btn-outline-primary" name="login" value="Log-in"  >
                        &nbsp&nbsp&nbsp
                        <input type="button" name="sign-up" value="sign-up" class="btn btn-outline-primary">
                    </div>
                </div>
            </div>


            <!--content-->
            <div class="col-xs-12 content">
                <div class="row content">
                    <div class="col-xs-1 side-bar">
                        <div class="row side-bar">    
                            <ul class="nav flex-column">
                              <li class="nav-item">
                                <a class="nav-link active" href="#">Active</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                              </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-11 main-content">
                        <div class="row main-content">
                            
                        </div>
                        
                    </div>
                </div>
            </div>



            <div class="col-xs-12 player">
                <div class="row player_row">
                    

                    <div class="col-xs-3 song_details">
                        <div class="row left_player_content">
                            <div class="col-xs-4 song_icon" id="songicon">
                                <img src="Image/img_404.jpg" class="img-thumbnail rounded mx-auto d-block" name="song_icon" width="100em" height="100em">
                            </div>

                            <div class="col-xs-4 song_name_artist">
                                <div class="row">
                                    <div class="col-xs-12 song_name" id="songname">
                                        <h4>Song: xyz</h4>
                                    </div>
                                    <div class="col-xs-12 song_artist" id="songartist">
                                        <h4>Song artist: xyz</h4>
                                    </div>    
                                </div>
                            </div>
                            <div class="col-xs-4 like">
                                <input id="like" type="image" src="Image/like.png"  name="like" width="35em" height="35em" >
                            </div>
                            
                        </div>
                    </div>


                    <div class="col-xs-6 bar_and_control">
                        <div class="row center_player_content">
                            <div class="col-xs-12 progress_bar">
                                
                                <div class="row time_bar">
                                    <div class="col-xs-1 start_time" id="timer">
                                        <span id="min">0</span>:<span id="sec">00</span>
                                    </div>
                                    <div class="col-xs-10 slider">
                                        <div class="row" id="progress-slider-handles">
                                            <script>
                                                var handlesSlider = document.getElementById('progress-slider-handles');
                                                    noUiSlider.create(handlesSlider, {
                                                    start: [0],
                                                    connect: [true, false],
                                                    range: {
                                                        'min': [0],
                                                        'max': [100]
                                                    }
                                                });
                                            </script>
                                        </div>
                                    </div>

                                    <div class="col-xs-1 end_time" id="end_time">
                                        0:00
                                    </div>
                                    
                                </div>

                            </div>


                            <div class="col-xs-12 basic_controls">
                                <div class="row basic_control">
                                    <div class="col-xs-1">
                                        
                                    </div>

                                    <div class="col-xs-2 shuffle">
                                        <input type="image" src="Image/shuffle.png" name="shuffle" width="25em" height="25em">
                                    </div>
                                    <div class="col-xs-2 previous">
                                        <input id="previous" type="image" src="Image/previous.png" name="prev" width="35em" height="35em">
                                    </div>
                                    <div class="col-xs-2 play">
                                        <input id="play" type="image" src="Image/play.png" name="play_pause" width="40px" height="50px" onclick="pause_play()">
                                        
                                        <input id="pause" type="image" src="Image/pause.png" name="play_pause" width="40px" height="50px" onclick="pause_play()" style="display: none;">
                                        
                                    </div>
                                    <div class="col-xs-2 next">
                                        <input id="next" type="image" src="Image/next.png" name="next" width="35px" height="35px">
                                    </div>
                                    <div class="col-xs-2 repeat">
                                        <input type="image" src="Image/repeat.png" name="repeat" width="25px" height="25px">
                                    </div>

                                    <div class="col-xs-1">
                                                
                                    </div>
                                    <script type="text/javascript">
                                        var updateTime;
                                        var updateBar;
                                            var pl = new Player([
                                                <?php
                                                    $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=music_store_project','root','');
                                                    
                                                    $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
                                                    $query=$dbhandler->query('select * from music');
                                                    while($r=$query->fetch()){
                                                            //echo specific attributes
                                                            //echo $r['message'], '<br/>';
                                                            //echo all data in both format: numeric and associative
                                                            echo '{';
                                                            echo 'title: '."'".$r['music_id']."',";
                                                            echo 'file: '."'".$r['music_id']."',";
                                                            echo 'howl: null';
                                                            echo '},';
                                                            
                                                    }
                                                    echo ']);'
                                                    . 'var s_n=[];';
                                                    $q1=$dbhandler->query('select * from music');
                                                    while($r=$q1->fetch()){
                                                        echo 's_n.push("'.$r['music_name'].'");';
                                                    }
                                                    $q2=$dbhandler->query('select * from music');
                                                    echo 'var s_a=[];';
                                                    while($r=$q2->fetch()){
                                                        echo 's_a.push("'.$r['artists'].'");';
                                                    }
                                                    $q3=$dbhandler->query('select * from music');
                                                    echo 'var s_i=[];';
                                                    while($r=$q3->fetch()){
                                                        echo 's_i.push("'.$r['music_id'].'");';
                                                    }
                                                  
                                                  ?>
                                                  
                                            var totalSeconds=0;
                                            $('#play').click(function(){
                                                document.getElementById("play").style.display = 'none';
                                                document.getElementById("pause").style.display = 'block';
                                                

                                                  // Bind our player controls.
                                                  pl.play();
                                                  updateTime=setInterval(setTime,1000);
                                                  updateBar=setInterval(setBar,1000);
                                                  
                                                  
                                            });
                                            
                                            $('#pause').click(function(){
                                                document.getElementById("pause").style.display = 'none';
                                                document.getElementById("play").style.display = 'block';
                                                pl.pause();
                                                window.clearInterval(updateTime);
                                            });
                                            
                                            
                                            $('#next').click(function(){
                                                document.getElementById("play").style.display = 'none';
                                                document.getElementById("pause").style.display = 'block';
                                                pl.skip('next');
                                                totalSeconds=0;
                                            });
                                            $('#previous').click(function(){
                                                document.getElementById("play").style.display = 'none';
                                                document.getElementById("pause").style.display = 'block';
                                                pl.skip('prev');
                                                totalSeconds=0;
                                            });
                                            $('#progress-slider-handles').click(function(){
                                                //stop the moving time and stop the moving bar
                                               window.clearInterval(updateBar);
                                               window.clearInterval(updateTime);
                                               //set bar to new position
                                               var sl = document.getElementById('progress-slider-handles');
                                               var g=sl.noUiSlider.get();
                                               sl.noUiSlider.set(g);
                                               //now to set time get the percent at which it is set right now
                                               var setat=sl.noUiSlider.get();
                                               console.log(g);
                                               //from total duration find percent of second
                                               //get total duration in second
                                                var d_sec=0;
                                                var t_str=document.getElementById("end_time").textContent;
                                                d_sec+=parseInt(t_str.split(":")[1]);
                                                d_sec+=parseInt(t_str.split(":")[0]*60);
                                                var sec_percent=parseInt((setat/100)*d_sec);
                                                //convert this sec percent as current time and set it as total seconds
                                                totalSeconds=sec_percent-1;
                                                setTime();
                                                var s=pl.sound();
//                                               console.log(pl.sound().seek(20))
                                                s.seek(sec_percent);
                                                
                                                updateTime=setInterval(setTime,1000);
                                                updateBar=setInterval(setBar,1000);
                                                
//                                                
                                               
                                            });
                                            function setBar(){
                                                //convert the current song time in seconds
                                                var t_sec=totalSeconds;
                                                
                                                //duration in seconds
                                                var d_sec=0;
                                                var t_str=document.getElementById("end_time").textContent;
                                                d_sec+=parseInt(t_str.split(":")[1]);
                                                d_sec+=parseInt(t_str.split(":")[0]*60);
                                                //per_completed calculation
                                                t_per=((t_sec*100)/d_sec);
                                                
                                                //setting the bar
                                                var sl = document.getElementById('progress-slider-handles');
                                                sl.noUiSlider.set(t_per);
                                            }
                                            function setTime(){
                                                ++totalSeconds;
                                                document.getElementById("sec").innerHTML = pad(totalSeconds % 60);
                                                document.getElementById("min").innerHTML = pad(parseInt(totalSeconds / 60));
                                            }

                                            function pad(val) {
                                              var valString = val + "";
                                              if (valString.length < 2) {
                                                return "0" + valString;
                                              } else {
                                                return valString;
                                              }
                                            }
                                        </script>
                                    
                                </div>    
                            </div>
                            
                        </div>
                    </div>


                    <!--
                        
                        <input id="previous" type="image" src="previous.png" name="prev" width="55px" height="55px" onclick="sound.pause()">
                        <input id="play" type="image" src="play.png" name="play_pause" width="60px" height="70px" onclick="sound.play()">
                        <input id="next" type="image" src="next.png" name="next" width="55px" height="55px">
                    -->
                    <div class="col-xs-3 volume_queue">
                        <div class="row right_player_content">
                            <div class="col-xs-2 queue">
                                <div class="row queue">
                                    <input id="queue" type="image" src="Image/playlist.png" name="playlist" width="35px" height="35px">             
                                </div>
                            </div>
                            <div class="col-xs-2 volume">
                                <div class="row volume" >
                                    <input type="image" id="unmute" src="Image/unmute.png" name="playlist" width="35px" height="35px" >             
                                </div>
                                <div class="row volume" >
                                    <input type="image" id="mute" src="Image/mute.png" name="playlist" width="35px" height="35px" style="display: none;">             
                                </div>
                            </div>
                            <div class="col-xs-8 slider">
                                <div class="row" id="volume-slider-handles">
                                    <script>
                                        var handlesSlider = document.getElementById('volume-slider-handles');
                                            noUiSlider.create(handlesSlider, {
                                            start: [100],
                                            connect: [true, false],
                                            range: {
                                                'min': [0],
                                                'max': [100]
                                            }
                                        });
                                        var mute_pos=100;
                                        $('#mute').click(function(){
                                            document.getElementById("unmute").style.display = 'block';
                                                document.getElementById("mute").style.display = 'none';
                                            
                                                
                                                
                                                var vslider = document.getElementById("volume-slider-handles");
                                                vslider.noUiSlider.set(mute_pos);
                                                pl.volume(mute_pos/100);
                                        });
                                        $('#unmute').click(function(){
                                            document.getElementById("mute").style.display = 'block';
                                                document.getElementById("unmute").style.display = 'none';
                                                
                                                var vslider = document.getElementById("volume-slider-handles");
                                                mute_pos=vslider.noUiSlider.get();
                                                vslider.noUiSlider.set(0);
                                                pl.volume(0);
                                        });
                                        $('#volume-slider-handles').click(function(){
//                                            var v_p=volume-slider-handles.
                                            
                                            var vslider = document.getElementById("volume-slider-handles");
                                            var i=vslider.noUiSlider.get();
                                            if (parseInt(i)===0){
                                                console.log("hi")
                                                vslider.noUiSlider.set(0);
                                                document.getElementById("unmute").style.display = 'none';
                                                document.getElementById("mute").style.display = 'block';
                                                pl.volume(0);
                                            }
                                            else{
                                                document.getElementById("unmute").style.display = 'block';
                                                document.getElementById("mute").style.display = 'none';
                                                vslider.noUiSlider.set(i);
                                                pl.volume((i/100));
                                            }
                                            
                                        });
                                        
                                        
                                    </script>
                                </div>
                            </div>

                        </div>
                    </div>



                    
                </div>
            </div>
        </div>
    </div>
    
        
</body>
</html>