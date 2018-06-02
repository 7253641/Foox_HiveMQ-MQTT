<!DOCTYPE html>
<html lang="en">
<head>
  <title>Administrator</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/foundation.css">
  <link rel="stylesheet" href="css/jquery.minicolors.css">
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css">
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 550px}

    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }

    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: auto) {
      .row.content {height: auto;}
    }
  </style>
</head>

<body>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav hidden-xs">
      <h2 class="text-center">FOOX Admin</h2>
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="#section1">Dashboard</a></li>
        <li class="active">
            <label>Host *</label>
            <input id="urlInput" type="text" value="broker.mqttdashboard.com">
        </li>
        <li class="active">
            <label>Port *</label>
            <input id="portInput" type="text" value="8000"/>
        </li>
        <li class="active">
            <label>ClientID *</label>
            <input id="clientIdInput" type="text"/>
        </li>
        <li>
            <a id="connectButton" class="btn btn-success"
            onclick="websocketclient.connect();">Connect</a>
        </li>
        <li>
            <a id="disconnectButton" class="btn btn-danger"
               onclick="websocketclient.disconnect();">Disconnect</a>
        </li>
      </ul><br>
    </div>

      <div class="col-sm-6">
        <div class="well">
          <p>Welcome, Users</p>
        </div>
      </div>
    <div class="col-sm-3">
        <div class="well">
          <p>You </p>
        </div>
      </div>

    <div class="col-sm-9">
      <div class="well">
        <h4>Connect to Device</h4>
                <div class="panel">
                    <div class="row">
                        <form class="custom">
                          <div class="row panel" id="publishPanel">
                              <div class="large-12 columns">
                                  <form class="custom">
                                      <div class="row">
                                          <div class="large-6 columns">
                                              <label>Topic</label>
                                              <input id="publishTopic" type="text" value="testtopic/1">
                                          </div>
                                          <div class="large-2 columns">
                                              <label for="publishQoSInput">QoS</label>
                                              <select id="publishQoSInput" class="small">
                                                  <option>0</option>
                                                  <option>1</option>
                                                  <option>2</option>
                                              </select>
                                          </div>
                                          <div class="large-2 columns">
                                              <label>Retain</label>
                                              <input id="publishRetain" type="checkbox">
                                          </div>
                                          <div class="large-2 columns">
                                              <a class="small button" id="publishButton"
                                                 onclick="websocketclient.publish($('#publishTopic').val(),$('#publishPayload').val(),parseInt($('#publishQoSInput').val(),10),$('#publishRetain').is(':checked'))">Publish</a>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="large-12 columns">
                                              <label>Message</label>
                                              <textarea id="publishPayload"></textarea>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                    </div>
                </div>
      </div>
    </div>

    <div class="col-sm-9">
      <div class="well">
            <h4>Messages from Device</h4>

        <div class="large-12 columns" id="messagesMain">
            <div class="row panel">
                <div class="large-12 columns">
                    <form class="custom">
                    </form>
                        <div class="row">
                            <ul id="messEdit" class="disc">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>

    </div>
  </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/lodash.js/1.3.1/lodash.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

<script src="http://cdnjs.cloudflare.com/ajax/libs/foundation/4.2.3/js/foundation.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/foundation/4.2.3/js/foundation/foundation.forms.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.1.0/moment.min.js"></script>
<script src="js/jquery.minicolors.min.js"></script>
<script src="js/mqttws31.js"></script>
<script src="js/encoder.js"></script>
<script src="js/app.js"></script>
<script src="config.js"></script>

<script>

    function randomString(length) {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for (var i = 0; i < length; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        return text;
    }

    $(document).foundation();
    $(document).ready(function () {

        $('#urlInput').val(websocketserver);
        $('#portInput').val(websocketport);
        $('#clientIdInput').val('clientId-' + randomString(10));

        $('#colorChooser').minicolors();

        $("#addSubButton").fancybox({
            'afterShow': function () {
                var rndColor = websocketclient.getRandomColor();
                $("#colorChooser").minicolors('value', rndColor);
            }
        });
    });
</script>

</body>
</html>
