<!---general settings page--->
@extends('editor.layout')

@section('content')

<div class="max-w-4xl mx-auto py-8 px-4">
  <!-- Header -->
  <div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">General Settings</h1>
    <p class="text-gray-600">Manage your general settings and preferences.</p>
  </div>

  <!-- Site Information Section -->
  <div class="bg-white rounded-lg shadow-md p-6 mb-8">
    <div class="flex justify-between items-start mb-6">
      <div>
        <h2 class="text-xl font-semibold text-gray-900">Site Information</h2>
        <p class="text-gray-600 text-sm mt-1">Update your site title, description, and other basic information.</p>
      </div>
      <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">
        Edit Site Information
      </button>
    </div>

    <form action="#" method="POST" class="border-t pt-6">
      @csrf
      @method('PUT')
      <div class="grid grid-cols-1 gap-5">
        <div>
          <label for="site_title" class="block text-gray-700 font-medium mb-2">Site Title</label>
          <input type="text" id="site_title" name="site_title" value="{{ $settings->site_title ?? 'My Website' }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
          <label for="site_description" class="block text-gray-700 font-medium mb-2">Site Description</label>
          <textarea id="site_description" name="site_description" rows="3"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ $settings->site_description ?? '' }}</textarea>
        </div>

        <div>
          <label for="site_email" class="block text-gray-700 font-medium mb-2">Site Email</label>
          <input type="email" id="site_email" name="site_email" value="{{ $settings->site_email ?? '' }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
          <label for="site_phone" class="block text-gray-700 font-medium mb-2">Site Phone</label>
          <input type="text" id="site_phone" name="site_phone" value="{{ $settings->site_phone ?? '' }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
          <label for="site_address" class="block text-gray-700 font-medium mb-2">Site Address</label>
          <textarea id="site_address" name="site_address" rows="2"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ $settings->site_address ?? '' }}</textarea>
        </div>
      </div>

      <div class="mt-6">
        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
          Save Changes
        </button>
      </div>
    </form>
  </div>

  <!-- Timezone & Language Section -->
  <div class="bg-white rounded-lg shadow-md p-6 mb-8">
    <div class="flex justify-between items-start mb-6">
      <div>
        <h2 class="text-xl font-semibold text-gray-900">Timezone & Language</h2>
        <p class="text-gray-600 text-sm mt-1">Set your preferred timezone and language for the site.</p>
      </div>
      <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">
        Edit Timezone & Language
      </button>
    </div>

    <form action="#" method="POST" class="border-t pt-6">
      @csrf
      @method('PUT')
      <div class="grid grid-cols-1 gap-5">
        <div>
          <label for="timezone" class="block text-gray-700 font-medium mb-2">Timezone</label>
          <select id="timezone" name="timezone"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @foreach(timezone_identifiers_list() as $tz)
            <option value="{{ $tz }}" {{ ($settings->timezone ?? 'UTC') === $tz ? 'selected' : '' }}>{{ $tz }}</option>
            @endforeach
          </select>
        </div>

        <div>
          <label for="language" class="block text-gray-700 font-medium mb-2">Language</label>
          <select id="language" name="language"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="en" {{ ($settings->language ?? 'en') === 'en' ? 'selected' : '' }}>English</option>
            <option value="es" {{ ($settings->language ?? '') === 'es' ? 'selected' : '' }}>Spanish</option>
            <option value="fr" {{ ($settings->language ?? '') === 'fr' ? 'selected' : '' }}>French</option>
            <option value="de" {{ ($settings->language ?? '') === 'de' ? 'selected' : '' }}>German</option>
            <option value="ja" {{ ($settings->language ?? '') === 'ja' ? 'selected' : '' }}>Japanese</option>
            <option value="zh" {{ ($settings->language ?? '') === 'zh' ? 'selected' : '' }}>Chinese</option>
          </select>
        </div>
      </div>

      <div class="mt-6">
        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
          Save Changes
        </button>
      </div>
    </form>
  </div>

  <!-- Logo & Branding Section -->
  <div class="bg-white rounded-lg shadow-md p-6 mb-8">
    <div class="flex justify-between items-start mb-6">
      <div>
        <h2 class="text-xl font-semibold text-gray-900">Logo & Branding</h2>
        <p class="text-gray-600 text-sm mt-1">Customize your site's logo and branding elements.</p>
      </div>
      <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">
        Edit Logo & Branding
      </button>
    </div>

    <form action="#" method="POST" enctype="multipart/form-data" class="border-t pt-6">
      @csrf
      @method('PUT')
      <div>
        <label class="block text-gray-700 font-medium mb-2">Current Logo</label>
        @if($settings->logo ?? false)
        <img src="{{ asset('storage/' . $settings->logo) }}" alt="Current Logo" class="mb-4 h-20 w-auto object-contain border rounded-lg p-2">
        @else
        <div class="mb-4 h-20 w-20 bg-gray-100 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-300">
          <span class="text-gray-400 text-sm">No logo</span>
        </div>
        @endif

        <label for="logo" class="block text-gray-700 font-medium mb-2">Upload New Logo</label>
        <input type="file" id="logo" name="logo" accept="image/*"
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
        <p class="text-gray-500 text-sm mt-2">Recommended size: 200x50px. Max file size: 2MB</p>
      </div>

      <div class="mt-6">
        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
          Save Changes
        </button>
      </div>
    </form>
  </div>

  <!-- Theme Settings Section -->
  <div class="bg-white rounded-lg shadow-md p-6 mb-8">
    <div class="mb-6">
      <h2 class="text-xl font-semibold text-gray-900">Theme Settings</h2>
      <p class="text-gray-600 text-sm mt-1">Customize your site's appearance and color scheme.</p>
    </div>

    <form action="#" method="POST" class="border-t pt-6">
      @csrf
      @method('PUT')
      <div class="grid grid-cols-1 gap-5">
        <div>
          <label for="theme" class="block text-gray-700 font-medium mb-2">Site Theme</label>
          <select id="theme" name="theme"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="light" {{ ($settings->theme ?? 'light') === 'light' ? 'selected' : '' }}>Light</option>
            <option value="dark" {{ ($settings->theme ?? '') === 'dark' ? 'selected' : '' }}>Dark</option>
            <option value="auto" {{ ($settings->theme ?? '') === 'auto' ? 'selected' : '' }}>Auto (System Preference)</option>
          </select>
        </div>

        <div>
          <label for="editor-site-theme" class="block text-gray-700 font-medium mb-2">Editor Theme</label>
          <select id="editor-site-theme" name="editor_theme"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="blue-pink" {{ ($settings->editor_theme ?? 'blue-pink') === 'blue-pink' ? 'selected' : '' }}>Blue & Pink</option>
            <option value="green-yellow" {{ ($settings->editor_theme ?? '') === 'green-yellow' ? 'selected' : '' }}>Green & Yellow</option>
            <option value="purple-orange" {{ ($settings->editor_theme ?? '') === 'purple-orange' ? 'selected' : '' }}>Purple & Orange</option>
            <option value="red-gray" {{ ($settings->editor_theme ?? '') === 'red-gray' ? 'selected' : '' }}>Red & Gray</option>
          </select>
        </div>
      </div>

      <div class="mt-6">
        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
          Save Theme
        </button>
      </div>
    </form>
  </div>

  <!-- Backup & Restore Section -->
  <div class="bg-white rounded-lg shadow-md p-6">
    <div class="mb-6">
      <h2 class="text-xl font-semibold text-gray-900">Backup & Restore</h2>
      <p class="text-gray-600 text-sm mt-1">Create backups of your site data and restore from previous backups.</p>
    </div>

    <div class="border-t pt-6 flex gap-4">
      <form action="#" method="POST" class="inline">
        @csrf
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
          Create Backup
        </button>
      </form>

      <form action="#" method="POST" class="inline">
        @csrf
        @method('PUT')
        <button type="submit" class="bg-yellow-600 text-white px-6 py-2 rounded-lg hover:bg-yellow-700 transition-colors">
          Restore Backup
        </button>
      </form>
    </div>
  </div>
</div>

@endsection