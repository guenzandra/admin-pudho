@extends('admin.layout')

@section('content')

<div class="">
<!--log of the website, like the user activity log, the system log, etc.--->
<div class="">
  <h2>Logs</h2>
  <p></p>

  <div class="">
    <button class="user-activity-log">User Activity Log</button>
    <button class="system-log">System Log</button>
    <button class="error-log">Error Log</button>
  </div>

  <div class="">
    <!---table of the logs, with the columns: date, time, user, activity, status, etc.--->
    <table class="logs-table">
      <thead>
        <tr>
          <th>Date</th>
          <th>Time</th>
          <th>User</th>
          <th>Activity</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <!---sample data, replace with real data from the database--->
        <tr>
          <td>2024-06-01</td>
          <td>10:00 AM</td>
          <td>John Doe</td>
          <td>Logged in</td>
          <td>Success</td>
        </tr>
        <tr>
          <td>2024-06-01</td>
          <td>10:05 AM</td>
          <td>Jane Smith</td>
          <td>Updated profile</td>
          <td>Success</td>
        </tr>
        <!---more sample data--->
      </tbody>  
    </table>
    </div>
</div>

@endsection