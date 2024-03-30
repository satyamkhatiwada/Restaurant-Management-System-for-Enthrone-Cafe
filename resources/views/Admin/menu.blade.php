<div class="flex">
    @include('admin/adminNavbar')

    <div class="content mt-16" style="margin-left:18%; height:1000px;">
        <h1 class="emp-text">Menu</h1>
        <div class="add-employee">
            <a href="{{route('addMenu')}}"><button>Create Menu</button></a>
            <a href="{{route('addCategory')}}"><button>Add category</button></a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th colspan="2" style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $sn = $menuItems->firstItem();
                @endphp
                @foreach($menuItems as $menuItem)
                    <tr>
                        <td>{{$sn++}}</td>
                        <td>
                            <img src="{{ asset('storage/' . $menuItem->image) }}" alt="{{ $menuItem->name }}" style="width: 100px;">
                        </td>
                        <td>{{ $menuItem->name }}</td>
                        <td>{{ $menuItem->category->category }}</td>
                        <td>{{ $menuItem->price }}</td>
                        <td>{{ $menuItem->description }}</td>
                        <td>
                            <form action="{{ route('updateStatus', $menuItem->id) }}" method="POST" id="statusForm_{{ $menuItem->id }}" class="form-center">
                                @csrf
                                @method('PUT')
                                <!-- Hidden input field for status -->
                                <input type="hidden" name="status" id="status_{{ $menuItem->id }}" value="{{ $menuItem->status }}">
                                <!-- Toggle slider input for status -->
                                <label class="switch">
                                    <input type="checkbox" id="statusToggle_{{ $menuItem->id }}" {{ $menuItem->status === 'active' ? 'checked' : '' }} onchange="updateStatusToggle(this, '{{ $menuItem->id }}')">
                                    <span class="slider round"></span>
                                </label>
                            </form>
                        </td>

                        <td>
                            <a href="{{ route('editMenu', $menuItem->id) }}">
                                <img src="{{ asset('img/edit.png') }}" alt="Edit" style="width: 30px;">
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('deleteMenu', ['id' => $menuItem->id]) }}" method="post" class="form-center">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this item?')">
                                    <img src="{{ asset('img/delete.png') }}" alt="Delete" style="width: 30px;">
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        {{ $menuItems->links() }}
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
        width: 20%;
        background-color: #7978E9;
        border: 1px solid #7978E9;
        padding: 10px;
        border-radius: 10px;
        color: white;
        cursor: pointer; /* Add a pointer cursor on hover */
    }

    .add-employee button:hover {
        background-color: white;
        color: black;
    }

    /* Add some styling for the table, adjust as needed */
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
        background-color: white;
        color: #4B49AC;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 30px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 2px;
        bottom: 2px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    .form-center{
        margin: auto;
    }

</style>

<script>
    function updateStatusToggle(toggle, itemId) {
    let statusInput = document.getElementById('status_' + itemId);
    if (statusInput) {
        statusInput.value = toggle.checked ? 'active' : 'inactive';
        let form = document.getElementById('statusForm_' + itemId);
        if (form) {
            form.submit(); // Submit the form
        } else {
            console.error('Form not found:', 'statusForm_' + itemId);
        }
    } else {
        console.error('Status input not found:', 'status_' + itemId);
    }
}
</script>
