<!---usermanagement for admin, staff--->
@extends('admin.layout')

@section('content')

<div class="">

  <div class="">

  <!---above table--->
  <div class="">
    <!--searchbar--->
  <div class="">
    <form actions="">
    <input placeholder="Search...">
    <button type="submit" class=""><i> </i></button>
    </form>
  </div>

  <!--- add button-->
  <div class="">
    <button type="" class="">Add User</button>
  </div>

</div>

<!---Table---->
<div class="">
  <table>
    <tr>
      <th>Name</th>
      <th>Position</th>
      <th>Username</th>
      <th>Password</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </table>
</div>

<!----form for Add User--->
<div class="">
<form type="" class="">
<label class=""> Personal Information</label>
<input type="text" placeholder="Enter Full Name"></input>

<div class="" id="drop-down gender">
<button type="" placeholder="">Gender</button> <!---dropdown gender Female/Male--->
</div>

<input type="" placeholder=""></input> <!----birthdate--->
<input type="contact" placeholder="Enter Contact Number"></input>
<input type="email" placeholder="Enter Email"></input>
<input type="" placeholder=""></input>

<label class="">Account</label>
<div class"" id="drop-down position">
  <!---role base access--->
</div>

<input type="" placeholder="Generate Username..."><input>
<button type="" id="generate-username" class=""></button>

<input type="" placeholder="Generate Password..."></input>
<button type="" id="generate-password" class=""></button>
</form>

<!---save button/successfull add user--->
  <div class="">
  <button type="" class="">Save</button>
  </div>

</div>

</div>



</div>

@endsection