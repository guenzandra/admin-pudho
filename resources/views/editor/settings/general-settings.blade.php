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
    <form action="{{ route('') }}" method="POST" class="mt-4">
      @csrf
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

<div class="">
  <h1 class="text-xl font-semibold mb-4">Logo & Branding</h1>
  <p class="text-gray-600 mb-6">Customize your site's logo and branding elements.</p>
  <div class="">
    <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit Logo & Branding</button>
    
    <form action="{{ route('') }}" method="POST" enctype="multipart/form-data" class="mt-4">
      @csrf
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
  <div class="">
    <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" onclick="toggleDarkMode()">Toggle Dark Mode</button>
  </div>

  <div class="mt-4">
    <label for="theme" class="block text-gray-700 font-bold mb-2">Select Theme:</label>
    <select id="theme" name="theme" class="w-full px-3 py-2 border rounded">
      <option value="light" {{ $settings->theme === 'light' ? 'selected' : '' }}>Light</option>
      <option value="dark" {{ $settings->theme === 'dark' ? 'selected' : '' }}>Dark</option>
      <option value="auto" {{ $settings->theme === 'auto' ? 'selected' : '' }}>Auto (System Preference)</option>
    </select>
    <label for="editor-site-theme">
      <select id="editor-site-theme" name="editor_theme" class="w-full px-3 py-2 border rounded">
        <option value="blue-pink" {{ $settings->editor_theme === 'blue-pink' ? 'selected' : '' }}>Blue & Pink</option>
        <option value="green-yellow" {{ $settings->editor_theme === 'green-yellow' ? 'selected' : '' }}>Green & Yellow</option>
        <option value="purple-orange" {{ $settings->editor_theme === 'purple-orange' ? 'selected' : '' }}>Purple & Orange</option>
        <option value="red-gray" {{ $settings->editor_theme === 'red-gray' ? 'selected' : '' }}>Red & Gray</option>
      </select>
    </label>
    
    <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 mt-4" onclick="saveTheme()">Save Theme</button>
  </div>
</div>

</div>

@endsection