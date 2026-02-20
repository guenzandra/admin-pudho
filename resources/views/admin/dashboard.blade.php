@extends('admin.layout')

@section('content')

<div class="">
  <div class="">
    <!---overview cards--->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

    <!-- Total Residents Card -->
      <div class="bg-white p-4 rounded-lg shadow">
        <div class="flex items-center">
          <div class="p-3 rounded-full bg-red-100 text-red-500 mr-4">
            <!-- Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
          </div>
          <div>
            <p class="text-sm text-gray-500">Total Registered Residents</p>
            <p class="text-lg font-semibold">12,234</p>
          </div>
        </div>
      </div>

      <!---- Total Pending Applications Card --->
      <div class="bg-white p-4 rounded-lg shadow">
        <div class="flex items-center">
          <div class="p-3 rounded-full bg-yellow-100 text-yellow-500 mr-4">
            <!-- Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
            </svg>
          </div>
          <div>
            <p class="text-sm text-gray-500">Total Pending Applications</p>
            <p class="text-lg font-semibold">1,234</p>
          </div>
        </div>
      </div>

      <!--- Total Approved Applications Card --->
      <div class="bg-white p-4 rounded-lg shadow">
        <div class="flex items-center">
          <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
            <!-- Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <div>
            <p class="text-sm text-gray-500">Total Approved Applications</p>
            <p class="text-lg font-semibold">11,000</p>
          </div>
        </div>
      </div>

      <!---Total illegal squatters card--->
      <div class="bg-white p-4 rounded-lg shadow">
        <div class="flex items-center">
          <div class="p-3 rounded-full bg-red-100 text-red-500 mr-4">
            <!-- Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
            </svg>
          </div>
          <div>
            <p class="text-sm text-gray-500">Total Illegal Squatters</p>
            <p class="text-lg font-semibold">500</p>
          </div>
        </div>
      </div>
          

      

    </div>
      <!-- Repeat similar cards for Total Orders, Total Revenue, etc. -->
  </div>
</div>
@endsection