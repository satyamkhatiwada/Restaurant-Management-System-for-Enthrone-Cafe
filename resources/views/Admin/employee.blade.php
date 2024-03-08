<div class="flex">
    @include('admin/adminNavbar')

    <div class="content mt-16" style="margin-left:20%; height:1000px;">
        <h1 class="emp-text">Employee</h1>
        <div class="add-employee">
            <button><a href="{{route('addWaiter')}}">Create Waiter</a></button>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Waiter Code</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $sn = 1; // Initialize the serial number
                @endphp
                @foreach($waiter as $waiter)
                    <tr>
                        <td>{{$sn++}}</td>
                        <td>{{$waiter->code}}</td>
                        <td><div class="password-container">
                                <input type="password" value="{{$waiter->password}}" class="password-field" readonly>
                                <img src="{{ asset('img/eye.png') }}" class="toggle-password" alt="Show/Hide Password">
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    .flex {
        display: flex;
    }

    .content {
        flex: 1; /* Take up the remaining space */
        padding: 16px; /* Add padding to the content */
    }

    .emp-text {
        font-size: 25px;
        color: gray;
    }

    .add-employee {
        text-align: right; /* Align the button to the right */
        margin-top: 20px; /* Add margin for spacing */
    }

    .add-employee button {
        width:20%;
        background-color: #04AA6D;
        padding: 10px;
        border-radius: 10px;
        color: white;
        cursor: pointer; /* Add a pointer cursor on hover */
    }

    .add-employee button:hover {
        width:20%;
        background-color: white;
        border: 1px solid #04AA6D;
        padding: 10px;
        border-radius: 10px;
        color: black;
        cursor: pointer; /* Add a pointer cursor on hover */
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #04AA6D;
        color: white;
    }

    .password-container {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        width: 20px; /* Set the width of the image */
        height: auto; /* Maintain aspect ratio */
        cursor: pointer;
    }

    .password-field {
        padding-right: 20px; /* Add space for the image */
        border: none; /* Remove the border */
        outline: none; /* Remove the outline */
    }

</style>

<script>
    // JavaScript code to toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(function(icon) {
        icon.addEventListener('click', function() {
            var passwordField = this.previousElementSibling;
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                this.src = "{{ asset('img/eyeslash.png') }}"; // Change the image source to the eye-slash icon
            } else {
                passwordField.type = 'password';
                this.src = "{{ asset('img/eye.png') }}"; // Change the image source to the eye icon
            }
        });
    });
</script>



