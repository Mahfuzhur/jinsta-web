{{$selfInfo->user->username}}

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<button onclick="myFunction()">Click me</button>
<p id="demo"></p>
<script>
    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }
    function myFunction() {
        // document.getElementById("demo").innerHTML = "Hello World";
        // var xhttp = new XMLHttpRequest();
        // xhttp.onreadystatechange = function() {
        //     if (this.readyState == 4 && this.status == 200) {
        //          //document.getElementById("demo").innerHTML = this.responseText;
        //     }
        // };
        // xhttp.open("POST", "http://127.0.0.1:8000/dm", true);
        // xhttp.send();
        counter = 1;
        while (counter =>4) {

            $.ajax({
                type: "GET",
                data: {text:counter},
                url: "http://127.0.0.1:8000/dm",
                success:
            });
            sleep(Math.floor((Math.random() * 240) + 1));
            counter++;
        }


    }
</script>

