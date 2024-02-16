    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Encryprion Decryption</title>

        <style type="text/css">

        ::selection { background-color: #E13300; color: white; }
        ::-moz-selection { background-color: #E13300; color: white; }

        body {
            background-color: #fff;
            margin: 40px;
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
        }

        a {
            color: #003399;
            background-color: transparent;
            font-weight: normal;
        }

        h1 {
            color: #444;
            background-color: transparent;
            border-bottom: 1px solid #D0D0D0;
            font-size: 19px;
            font-weight: normal;
            margin: 0 0 14px 0;
            padding: 14px 15px 10px 15px;
        }

        code {
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
            font-size: 12px;
            background-color: #f9f9f9;
            border: 1px solid #D0D0D0;
            color: #002166;
            display: block;
            margin: 14px 0 14px 0;
            padding: 12px 10px 12px 10px;
        }

        #body {
            margin: 0 15px 0 15px;
        }

        p.footer {
            text-align: right;
            font-size: 11px;
            border-top: 1px solid #D0D0D0;
            line-height: 32px;
            padding: 0 10px 0 10px;
            margin: 20px 0 0 0;
        }

        #container {
            margin: 10px;
            border: 1px solid #D0D0D0;
            box-shadow: 0 0 8px #D0D0D0;
        }
        </style>
    </head>
    <body>

    <div id="container">
        <h1>Encryption & Decryption Demo</h1>

        <div id="body">
            
            <form action="{{route('web.enc-dec-data')}}" method="post">
                {{csrf_field()}}
                <label><b>Text or Encryption </b></label><br>
                <textarea name="data" id="data" required="" cols="90" rows="10"></textarea>
                <br>
                <br>
                <label for="encrypt"><b>Encrypt</b></label>
                <input type="radio" value="encrypt" name="type" id="encrypt" checked>
                <label for="decrypt"><b>Decrypt</b></label>
                <input type="radio" value="decrypt" name="type" id="decrypt">
                <!-- <select name="type" id="type" required="">
                    <option value="encrypt">encrypt</option>
                    <option value="decrypt">decrypt</option>
                </select> -->
                <br><br>
                <input type="submit" name="submit" value="submit">
                <br><br>
            </form>
            
            <?php echo "<div id='container'><div id='body'> OUTPUT <br><br>"; ?>
            <?php if (isset($encrypt_value)) { echo "<h2 onclick=CopyToClipboard('p1') style='cursor: pointer;'>COPY HASH</h2><p id='p1'>".$encrypt_value."</p>"; } ?>
            <?php if (isset($decrypt_value)) { echo "<h2 onclick=CopyToClipboard('p2') style='cursor: pointer;'>COPY ORIGINAL</h2>
            <p id='p2'>".$decrypt_value."</p>"; } ?>

            

            <?php if (isset($decrypt_value)) { echo "<h2 style='cursor: pointer;'>JSON</h2><pre>";print_r(json_decode($decrypt_value)); } ?>
            <?php echo "</div></div>"; ?>
            
        </div>
    </div>

    </body>
    <script type="text/javascript">
        function CopyToClipboard(containerid) {
            var container = document.getElementById(containerid);
            if (!container) return;

            container.style.display = "block";
            var range = document.createRange();
            range.selectNode(container);
            window.getSelection().addRange(range);

            navigator.clipboard.writeText(container.innerText).then(function() {
                window.getSelection().removeAllRanges();
                var successMessage = document.createElement("div");
                successMessage.innerHTML = "Copied Successfully!";
                successMessage.style.backgroundColor = "green";
                successMessage.style.color = "white";
                successMessage.style.padding = "10px";
                successMessage.style.position = "fixed";
                successMessage.style.top = "50%";
                successMessage.style.left = "50%";
                successMessage.style.transform = "translate(-50%, -50%)";
                document.body.appendChild(successMessage);
                setTimeout(function() {
                    successMessage.remove();
                }, 2500);
            }, function(err) {
                console.error('Failed to copy text: ', err);
            });
        }
    </script>
    </html>
