<!---general settings page--->
@extends('editor.layout')

@section('content')

<div class="">
  <div class="">
    <h1 class="text-2xl font-bold mb-4">General Settings</h1>
    <p class="text-gray-600 mb-6">Manage your general settings and preferences.</p>
  </div>
  <div class="">
    <h1 class="text-xl font-semibold mb-4">Site Information</h1>
    <p class="text-gray-600 mb-6">Update your site title, description, and other basic information.</p>
    <div class="">
      <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit Site Information</button>
      <form action="{{ route('settings.site-info.update') }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')
        <div class="mb-4">
          <label for="site_title" class="block text-gray-700 font-bold mb-2">Site Title</label>
          <input type="text" id="site_title" name="site_title" value="{{ $settings->site_title }}" class="w-full px-3 py-2 border rounded">
        </div>
        <div class="mb-4">
          <label for="site_description" class="block text-gray-700 font-bold mb-2">Site Description</label>
          <textarea id="site_description" name="site_description" class="w-full px-3 py-2 border rounded">{{ $settings->site_description }}</textarea>
        </div>

        <div class="mb-4">
          <label for="site_email" class="block text-gray-700 font-bold mb-2">Site Email</label>
          <input type="email" id="site_email" name="site_email" value="{{ $settings->site_email }}" class="w-full px-3 py-2 border rounded">
        </div>

        <div class="mb-4">
          <label for="site_phone" class="block text-gray-700 font-bold mb-2">Site Phone</label>
          <input type="text" id="site_phone" name="site_phone" value="{{ $settings->site_phone }}" class="w-full px-3 py-2 border rounded">
        </div>

        <div class="mb-4">
          <label for="site_address" class="block text-gray-700 font-bold mb-2">Site Address</label>
          <textarea id="site_address" name="site_address" class="w-full px-3 py-2 border rounded">{{ $settings->site_address }}</textarea>
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save Changes</button>
      </form>
    </div>
  </div>

  <!---timezone and language settings--->
  <div class="mt-8">
    <h1 class="text-xl font-semibold mb-4">Timezone & Language</h1>
    <p class="text-gray-600 mb-6">Set your preferred timezone and language for the site.</p>
    <div class="">
      <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit Timezone & Language</button>
      <form action="{{ route('settings.timezone-language.update') }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')
        <div class="mb-4">
          <label for="timezone" class="block text-gray-700 font-bold mb-2">Timezone</label>
          <select id="timezone" name="timezone" class="w-full px-3 py-2 border rounded">
            @foreach(timezone_identifiers_list() as $tz)
            <option value="{{ $tz }}" {{ $settings->timezone === $tz ? 'selected' : '' }}>{{ $tz }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-4">
          <label for="language" class="block text-gray-700 font-bold mb-2">Language</label>
          <select id="language" name="language" class="w-full px-3 py-2 border rounded">
            <option value="en" {{ $settings->language === 'en' ? 'selected' : '' }}>English</option>
            <option value="es" {{ $settings->language === 'es' ? 'selected' : '' }}>Spanish</option>
            <option value="fr" {{ $settings->language === 'fr' ? 'selected' : '' }}>French</option>
            <!-- Add more languages as needed -->
          </select>
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save Changes</button>
      </form>
    </div>
  </div>

  <div class="">
    <h1 class="text-xl font-semibold mb-4">Logo & Branding</h1>
    <p class="text-gray-600 mb-6">Customize your site's logo and branding elements.</p>
    <div class="">
      <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit Logo & Branding</button>

      <form action="{{ route('settings.logo.update') }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf
        @method('PUT')
        <div class="mb-4">
          <label for="logo" class="block text-gray-700 font-bold mb-2">Site Logo</label>
          <input type="file" id="logo" name="logo" class="w-full px-3 py-2 border rounded">
          @if($settings->logo)
          <img src="{{ asset('storage/' . $settings->logo) }}" alt="Current Logo" class="mt-4 h-16">
          @endif
          <p class="text-gray-500 text-sm mt-2">Upload a new logo for your site.</p>
        </div>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save Changes</button>
      </form>
    </div>
  </div>

  <div class="">
    <h1 class="text-xl font-semibold mb-4">Dark Mode</h1>
    <p class="text-gray-600 mb-6">Toggle dark mode for your site.</p>

    <form action="{{ route('settings.theme.update') }}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-4">
        <label for="theme" class="block text-gray-700 font-bold mb-2">Select Theme:</label>
        <select id="theme" name="theme" class="w-full px-3 py-2 border rounded">
          <option value="light" {{ $settings->theme === 'light' ? 'selected' : '' }}>Light</option>
          <option value="dark" {{ $settings->theme === 'dark' ? 'selected' : '' }}>Dark</option>
          <option value="auto" {{ $settings->theme === 'auto' ? 'selected' : '' }}>Auto (System Preference)</option>
        </select>
      </div>

      <div class="mb-4">
        <label for="editor-site-theme" class="block text-gray-700 font-bold mb-2">Editor Theme:</label>
        <select id="editor-site-theme" name="editor_theme" class="w-full px-3 py-2 border rounded">
          <option value="blue-pink" {{ $settings->editor_theme === 'blue-pink' ? 'selected' : '' }}>Blue & Pink</option>
          <option value="green-yellow" {{ $settings->editor_theme === 'green-yellow' ? 'selected' : '' }}>Green & Yellow</option>
          <option value="purple-orange" {{ $settings->editor_theme === 'purple-orange' ? 'selected' : '' }}>Purple & Orange</option>
          <option value="red-gray" {{ $settings->editor_theme === 'red-gray' ? 'selected' : '' }}>Red & Gray</option>
        </select>
      </div>

      <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save Theme</button>
    </form>
  </div>

  <!--backup and restore settings--->
  <div class="mt-8">
    <h1 class="text-xl font-semibold mb-4">Backup & Restore</h1>
    <p class="text-gray-600 mb-6">Create backups of your site data and restore from previous backups.</p>
    <div class="">
      <form action="{{ route('settings.backup.create') }}" method="POST" class="inline">
        @csrf
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create Backup</button>
      </form>
      <form action="{{ route('settings.backup.restore') }}" method="POST" class="inline ml-4">
        @csrf
        @method('PUT')
        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Restore Backup</button>
      </form>
    </div>
  </div>

</div>

@endsection