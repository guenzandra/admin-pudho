@extends('admin.layout')

@section('content')

<div class="">
  <div class="">
    <!---notifications settings of the website, like the email notifications, push notifications, etc.--->
    <h2>Notifications Settings</h2>
    <p></p>
    <div class="">
      <label for="email-notifications">Email Notifications:</label>
      <input type="checkbox" id="email-notifications" name="email-notifications" checked>

      <label for="push-notifications">Push Notifications:</label>
      <input type="checkbox" id="push-notifications" name="push-notifications">

      <button class="save-btn">Save Changes</button>
    </div>
  </div>

  <div class="">
    <!---notification view list, modal----- mark read if read, mark unread if unread, delete notification, etc.--->
  </div>
</div>

@endsection