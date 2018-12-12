<!doctype html>
<!-- See http://www.firepad.io/docs/ for detailed embedding docs. -->
<html>

<head>
  <meta charset="utf-8" />
  <!-- Firebase -->
  <script src="https://www.gstatic.com/firebasejs/3.3.0/firebase.js"></script>

  <!-- CodeMirror -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.17.0/codemirror.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.17.0/codemirror.css" />

  <!-- Firepad -->
  <link rel="stylesheet" href="/css/firepad.css" />
  <script src="https://cdn.firebase.com/libs/firepad/1.4.0/firepad.min.js"></script>

  <!-- Include example userlist script / CSS.
       Can be downloaded from: https://github.com/firebase/firepad/tree/master/examples/ -->
  
  <link rel="stylesheet" href="/css/user-style.css" />

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">
  
  <style>
    input[type=button] {
    background-color: #FF6B6C;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
    html { height: 100%; }
    body { margin: 0; height: 100%;
      background-color: #FFC145;
    }
    /* Height / width / positioning can be customized for your use case.
       For demo purposes, we make the user list 175px and firepad fill the rest of the page. */
    #userlist {
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    height: auto;
    width: 175px;
    background-color: #B8B8D1;
    }
    #firepad {
      position: absolute; left: 175px; top: 0; bottom: 0; right: 0; height: auto;
    }
    .kontener {
    
    position: absolute;
    left: 30px;
    top: 80px;
    right: 30px;
    bottom: 125px;
    background: white;
    -moz-box-shadow: 0 5px 25px #333;
    -webkit-box-shadow: 0 5px 25px #333;
    box-shadow: 0 5px 25px #333;
}
    .judul {
      margin-top: -40px;
      margin-left: 30px;
      color: #FFFFFB;
      font-size: 50px;
      font-family: 'Arial', cursive;
    }
    .description {
      position: absolute;
      bottom: 0px;
      right: 40px;
      width: 500px;
      height: 80px;
      font-size: 18px;
      color: white;
    }
    #share-box{
    position: absolute;
    left: 30px;
    bottom: 40px;
    width: 650px;
    height: 56px;
    }
    #share-features {
        height: 35px;
    }

  </style>
</head>

<body onload="init()">
            <div class="judul">
              <p>Notee</p>
            </div>
            <div class="kontener">
              <div id="userlist"></div>
              <div id="firepad"></div>
            </div>
          
          <div id="share-box">
          <div id="share-features">
            <table class="copyUrl">
              <tbody>
              <tr>
                <td>
                    <input type="button" value="Edit With Friends" onclick="Copy();" />
                </td>
              </tr>
                <tr>
                <td>
                  <div>
                    <textarea id="url" rows="1" cols="30"></textarea>
                  </div>
                </td>
                
              </tr>
              
            </tbody></table>
          </div>
        </div>
            <div class="description">Notee adalah web-based text editor yang berguna untuk menyimpan catatan dan berbagi secara real-time dengan orang lain.</div>
  <script>
    function init() {
      //// Initialize Firebase.
      //// TODO: replace with your Firebase project configuration.
      var config = {
        apiKey: "AIzaSyBxovfgUyLTjTBVcgh1rk0N2x_1m3Am8Ak",
        authDomain: "cobafirebaseweb.firebaseapp.com",
        databaseURL: "https://cobafirebaseweb.firebaseio.com",
        projectId: "cobafirebaseweb",
        storageBucket: "cobafirebaseweb.appspot.com",
        messagingSenderId: "901890414128"
      };
      firebase.initializeApp(config);

      //// Get Firebase Database reference.
      var firepadRef = getExampleRef();

      //// Create CodeMirror (with lineWrapping on).
      var codeMirror = CodeMirror(document.getElementById('firepad'), { lineWrapping: true });

      // Create a random ID to use as our user ID (we must give this to firepad and FirepadUserList).
      var userId = Math.floor(Math.random() * 9999999999).toString();

      //// Create Firepad (with rich text features and our desired userId).
      var firepad = Firepad.fromCodeMirror(firepadRef, codeMirror,
          { richTextToolbar: true, richTextShortcuts: true, userId: userId});

      //// Create FirepadUserList (with our desired userId).
      var firepadUserList = FirepadUserList.fromDiv(firepadRef.child('users'),
          document.getElementById('userlist'), userId);

      //// Initialize contents.
      firepad.on('ready', function() {
        if (firepad.isHistoryEmpty()) {
          firepad.setText('Catat..');
        }
      });


    }

    // Helper to get hash from end of URL or generate a random one.
    function getExampleRef() {
      var ref = firebase.database().ref();
      var hash = window.location.hash.replace(/#/g, '');
      if (hash) {
        ref = ref.child(hash);
      } else {
        ref = ref.push(); // generate unique location.
        window.location = window.location + '#' + ref.key; // add it as a hash to the URL.
      }
      if (typeof console !== 'undefined') {
        console.log('Firebase data: ', ref.toString());
      }
      return ref;
    }
    function Copy() {
    var Url = document.getElementById("url");
    Url.innerHTML = window.location.href;
    console.log(Url.innerHTML)
    Url.select();
    document.execCommand("copy");
  }


  </script>
  <script src="/js/user.js"></script>
</body>
</html>
