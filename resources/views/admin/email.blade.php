@foreach($users as $user)

{{$user->name}}<br>
@endforeach

<h2>Example3 - With TableLayout</h2>

<input type='button' value='Hide' id='but_hide' onclick='hideChecked();' />&nbsp;
<input type='button' value='Reset' id='but_reset' onclick='reset();' ><br/>

    <form action="{{URL::to('admin-email-list')}}" method="post">
        {{csrf_field()}}
        <table border='1' >
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th><input type='checkbox' name='showhide' onchange="checkAll(this)"></th>
            </tr>
        <?php $counter =0; ?>
        @foreach($users as $user)

        <tr id='tr_{{$counter}}'>
            <td align='center'>{{$user->name}}</td>
            <td align='center'>{{$user->company_name}}</td>
            <td align='center'>{{$user->email}}</td>
            <td align='center'><input type='checkbox' name='email[]' value="{{$user->email}}" id='check_{{$counter}}'></td>
        </tr>
        <?php $counter++;?>
        @endforeach
        </table>
        <button type="submit">submit</button>
    </form>



<script type='text/javascript'>

    // Set check or unchecked all checkboxes
    function checkAll(e) {
        var checkboxes = document.getElementsByName('email[]');

        if (e.checked) {
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = true;
            }
        } else {
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = false;
            }
        }
    }

    // Hide Checked rows
    function hideChecked(){
        var checkboxes = document.getElementsByName('email[]');

        for (var i = 0; i < checkboxes.length; i++) {
            var checkid = checkboxes[i].id;
            var split_id = checkid.split("_");
            var rowno = split_id[1];
            if(checkboxes[i].checked){
                document.getElementById("tr_"+rowno).style.display="none";
            }
        }

    }

    // Reset layout
    function reset(){
        var checkboxes = document.getElementsByName('email[]');
        document.getElementsByName("showhide")[0].checked=false;

        for (var i = 0; i < checkboxes.length; i++) {
            var checkid = checkboxes[i].id;
            var split_id = checkid.split("_");
            var rowno = split_id[1];
            document.getElementById("tr_"+rowno).style.display="table-row";
            checkboxes[i].checked = false;
        }

    }
</script>