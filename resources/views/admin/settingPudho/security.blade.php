@extends('admin.layout')

@section('content')

<div class="">
<!---security settings of the website, like the password policy, two-factor authentication, etc.--->
<div class="">
  <h2>Security Settings</h2>
  <p></p>

  <div class="">
    <label for="password-policy">Password Policy:</label>
    <select id="password-policy" name="password-policy">
      <option value="weak">Weak (min 6 characters)</option>
      <option value="medium">Medium (min 8 characters, letters and numbers)</option>
      <option value="strong">Strong (min 12 characters, letters, numbers, and symbols)</option>
    </select>

    <label for="two-factor-auth">Two-Factor Authentication:</label>
    <input type="checkbox" id="two-factor-auth" name="two-factor-auth">

    <button class="save-btn">Save Changes</button>
  </div>
  </div>
</div>

@endsection