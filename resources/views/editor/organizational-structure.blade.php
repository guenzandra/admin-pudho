@extends('editor.layout')

@section('content')
<div class="container-fluid px-6 py-8">

    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Organizational Structure</h1>
            <p class="text-gray-600 mt-2">Manage organizational chart and position descriptions</p>
        </div>
        <button onclick="openPublishModal()"
            class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-red-700 to-red-600 hover:from-red-800 hover:to-red-700 text-white text-sm font-semibold rounded-lg shadow transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            Preview &amp; Publish
        </button>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-red-700 to-red-800 px-6 py-4 border-l-4 border-indigo-500">
            <h2 class="text-xl font-semibold text-white">Organizational Chart</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="flex flex-wrap justify-between items-center gap-3 mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Current Organizational Chart</h3>
                        <div class="flex items-center gap-2 flex-wrap">

                            <div class="flex items-center bg-gray-100 rounded-lg p-1 gap-0.5">
                                <button id="btnVertical" onclick="setDirection('vertical')"
                                    class="dir-btn active flex items-center gap-1.5 px-3 py-1.5 rounded-md text-xs font-semibold transition-all">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16M8 8l4-4 4 4" />
                                    </svg>
                                    Vertical
                                </button>
                                <button id="btnHorizontal" onclick="setDirection('horizontal')"
                                    class="dir-btn flex items-center gap-1.5 px-3 py-1.5 rounded-md text-xs font-semibold transition-all">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 12h16M16 8l4 4-4 4" />
                                    </svg>
                                    Horizontal
                                </button>
                            </div>

                            <button onclick="openAddPersonModal()"
                                class="inline-flex items-center gap-1.5 px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-lg transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Add Person
                            </button>
                            <button onclick="document.getElementById('replaceModal').classList.remove('hidden')"
                                class="inline-flex items-center gap-1.5 px-3 py-2 bg-orange-600 hover:bg-orange-700 text-white text-xs font-semibold rounded-lg transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Replace Image
                            </button>
                        </div>
                    </div>

                    <div id="chartContainer" class="border-2 border-gray-200 rounded-xl bg-gray-50 relative overflow-hidden" style="height:560px;">
                        <div id="chartLoader" class="absolute inset-0 flex flex-col items-center justify-center bg-gray-50 z-20">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-10 h-10 border-4 border-red-200 border-t-red-700 rounded-full animate-spin"></div>
                                <p class="text-sm text-gray-500 font-medium">Building chart…</p>
                            </div>
                        </div>
                        <div id="svgViewport" style="width:100%;height:100%;overflow:hidden;cursor:grab;user-select:none;">
                            <svg id="orgSvg" xmlns="http://www.w3.org/2000/svg" style="display:block;overflow:visible;">
                                <g id="orgRoot"></g>
                            </svg>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 mt-3">
                        <button onclick="zoomOut()" class="px-3 py-1.5 text-sm border border-gray-300 bg-white hover:bg-gray-50 rounded-lg font-bold text-gray-600 transition-colors">−</button>
                        <span id="zoomLabel" class="text-xs font-mono font-semibold text-gray-500 bg-gray-100 px-3 py-1.5 rounded-lg min-w-[52px] text-center">100%</span>
                        <button onclick="zoomIn()" class="px-3 py-1.5 text-sm border border-gray-300 bg-white hover:bg-gray-50 rounded-lg font-bold text-gray-600 transition-colors">+</button>
                        <button onclick="fitChart()" class="px-3 py-1.5 text-xs border border-gray-300 bg-white hover:bg-gray-50 rounded-lg font-semibold text-gray-600 transition-colors">Fit</button>
                        <span class="text-xs text-gray-400 ml-1">Hover node for options · Drag to pan · Scroll to zoom · <span id="memberCount" class="font-semibold text-gray-500">0</span> members</span>
                    </div>

                    <div class="mt-4 p-4 bg-indigo-50 rounded-lg border-l-4 border-indigo-500">
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-indigo-800 font-medium">Current Version</p>
                                <p class="text-indigo-600">v2.1 — Updated March 1, 2026</p>
                            </div>
                            <div>
                                <p class="text-indigo-800 font-medium">Total Members</p>
                                <p class="text-indigo-600" id="memberCountInfo">Loading…</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="bg-gray-50 rounded-lg p-4 mb-4">
                        <h4 class="font-medium text-gray-900 mb-3">Quick Actions</h4>
                        <div class="space-y-2">
                            <button onclick="downloadChart()" class="w-full flex items-center gap-2 px-3 py-2 bg-white hover:bg-gray-100 border border-gray-300 rounded-lg text-left text-sm text-gray-700 transition-colors">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Download Current Chart
                            </button>
                            <button onclick="viewVersions()" class="w-full flex items-center gap-2 px-3 py-2 bg-white hover:bg-gray-100 border border-gray-300 rounded-lg text-left text-sm text-gray-700 transition-colors">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                View Version History
                            </button>
                            <button onclick="window.print()" class="w-full flex items-center gap-2 px-3 py-2 bg-white hover:bg-gray-100 border border-gray-300 rounded-lg text-left text-sm text-gray-700 transition-colors">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                </svg>
                                Print Chart
                            </button>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 mb-4">
                        <h4 class="font-medium text-gray-900 mb-3">Legend</h4>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2 text-xs text-gray-600"><span class="w-3 h-3 rounded-sm flex-shrink-0" style="background:#7f1d1d;"></span>Top Leadership</div>
                            <div class="flex items-center gap-2 text-xs text-gray-600"><span class="w-3 h-3 rounded-sm flex-shrink-0" style="background:#b91c1c;"></span>Director / Executive</div>
                            <div class="flex items-center gap-2 text-xs text-gray-600"><span class="w-3 h-3 rounded-sm flex-shrink-0" style="background:#d97706;"></span>Unit Head</div>
                            <div class="flex items-center gap-2 text-xs text-gray-600"><span class="w-3 h-3 rounded-sm flex-shrink-0" style="background:#1d4ed8;"></span>Staff</div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="font-medium text-gray-900 mb-3">Chart Guidelines</h4>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Recommended size: 1200×800px</li>
                            <li>• Supported formats: PNG, JPG, PDF</li>
                            <li>• Maximum file size: 5MB</li>
                            <li>• Ensure text is readable</li>
                            <li>• Use high-resolution images</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-red-700 to-red-800 px-6 py-4 border-l-4 border-teal-500">
            <h2 class="text-xl font-semibold text-white">Position List &amp; Descriptions</h2>
        </div>
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-medium text-gray-900">Current Positions</h3>
                <button onclick="openPositionModal()" class="inline-flex items-center gap-2 px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Position
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="positionsGrid"></div>
        </div>
    </div>

</div>

<div id="nodePopup" class="hidden fixed z-50 bg-white border border-gray-200 rounded-xl shadow-2xl p-4 w-64" style="pointer-events:none;">
    <div class="flex items-start gap-3 mb-3">
        <div id="popupAvatar" class="w-10 h-10 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0 text-white ring-2 ring-white shadow"></div>
        <div class="min-w-0">
            <p class="text-sm font-bold text-gray-900 leading-tight" id="popupName"></p>
            <p class="text-xs text-gray-500 mt-0.5" id="popupRole"></p>
            <span class="inline-block text-xs font-semibold px-2 py-0.5 rounded-full mt-1.5" id="popupBadge"></span>
        </div>
    </div>
    <div class="flex gap-2" style="pointer-events:all;">
        <button id="popupEditBtn" class="flex-1 flex items-center justify-center gap-1 px-2 py-1.5 text-xs font-semibold bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg transition-colors">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Edit
        </button>
        <button id="popupDeleteBtn" class="flex-1 flex items-center justify-center gap-1 px-2 py-1.5 text-xs font-semibold bg-red-50 hover:bg-red-100 text-red-700 rounded-lg transition-colors">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
            Remove
        </button>
    </div>
</div>

<div id="replaceModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 w-11/12 md:w-1/2 shadow-lg rounded-xl bg-white">
        <div class="flex justify-between items-center pb-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-900">Replace Organizational Chart</h3>
            <button onclick="document.getElementById('replaceModal').classList.add('hidden')" class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-500">✕</button>
        </div>
        <div class="mt-4 space-y-4">
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                <p class="text-sm text-yellow-800"><strong>Warning:</strong> Replacing the chart will overwrite the existing image. Consider a backup first.</p>
            </div>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-gray-400 transition-colors cursor-pointer" onclick="document.getElementById('chartReplaceFile').click()">
                <svg class="mx-auto w-10 h-10 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                <p class="text-sm text-gray-600">Click to upload or drag and drop</p>
                <p class="text-xs text-gray-400 mt-1">PNG, JPG, PDF up to 5MB</p>
                <input type="file" id="chartReplaceFile" accept="image/*,.pdf" class="hidden">
            </div>
            <div id="replacePreviewWrap" class="hidden">
                <p class="text-sm font-medium text-gray-700 mb-2">Preview</p>
                <img id="replacePreviewImg" src="" alt="Preview" class="w-full h-auto max-h-64 object-contain border border-gray-200 rounded-lg">
            </div>
        </div>
        <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
            <button onclick="document.getElementById('replaceModal').classList.add('hidden')" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium">Cancel</button>
            <button onclick="fakeReplaceChart()" class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg text-sm font-medium">Replace Chart</button>
        </div>
    </div>
</div>

<div id="addPersonModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-16 mx-auto p-5 w-11/12 md:w-1/2 shadow-lg rounded-xl bg-white">
        <div class="flex justify-between items-center pb-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-900" id="addPersonTitle">Add Person to Chart</h3>
            <button onclick="document.getElementById('addPersonModal').classList.add('hidden')" class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-500">✕</button>
        </div>
        <div class="mt-4 space-y-4">
            <input type="hidden" id="editPersonId">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Full Name <span class="text-red-500">*</span></label>
                <input type="text" id="personName" placeholder="e.g. Juan Dela Cruz" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Position / Role <span class="text-red-500">*</span></label>
                <input type="text" id="personRole" placeholder="e.g. Housing Officer" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Classification</label>
                    <select id="personLevel" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                        <option value="top">Top Leadership</option>
                        <option value="director">Director / Executive</option>
                        <option value="unit">Unit Head</option>
                        <option value="staff" selected>Staff</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Unit</label>
                    <select id="personUnit" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                        <option value="">— None —</option>
                        <option value="AGSU">Admin &amp; General Services</option>
                        <option value="OFWU">Operations &amp; Field Work</option>
                        <option value="TSPU">Technical &amp; Special Project</option>
                        <option value="IRU">Institutional Relations</option>
                        <option value="MCU">Media &amp; Communications</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Reports To</label>
                <input type="text" id="personReportsTo" placeholder="Enter the exact name of their supervisor" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                <p class="text-xs text-gray-400 mt-1">Must match the supervisor's name exactly as it appears in the chart.</p>
            </div>
        </div>
        <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
            <button onclick="document.getElementById('addPersonModal').classList.add('hidden')" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium">Cancel</button>
            <button id="savePersonBtn" onclick="savePerson()" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Save Person
            </button>
        </div>
    </div>
</div>

<div id="positionModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-16 mx-auto p-5 w-11/12 md:w-1/2 shadow-lg rounded-xl bg-white">
        <div class="flex justify-between items-center pb-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-900" id="posModalTitle">Add Position</h3>
            <button onclick="document.getElementById('positionModal').classList.add('hidden')" class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-500">✕</button>
        </div>
        <div class="mt-4 space-y-4">
            <input type="hidden" id="editPosId">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Position Title <span class="text-red-500">*</span></label>
                <input type="text" id="posTitle" placeholder="e.g. Housing Officer" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gray-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Level</label>
                <select id="posLevel" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gray-500 outline-none">
                    <option value="executive">Executive Level</option>
                    <option value="management">Management Level</option>
                    <option value="staff">Staff Level</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Responsibilities <span class="text-xs text-gray-400">(one per line)</span></label>
                <textarea id="posResponsibilities" rows="4" placeholder="Overall strategic leadership&#10;Policy development&#10;Stakeholder relations" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gray-500 outline-none resize-none"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Reports To</label>
                <input type="text" id="posReportsTo" placeholder="e.g. Board of Directors" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gray-500 outline-none">
            </div>
        </div>
        <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
            <button onclick="document.getElementById('positionModal').classList.add('hidden')" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium">Cancel</button>
            <button onclick="savePosition()" class="inline-flex items-center gap-2 px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white rounded-lg text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Save Position
            </button>
        </div>
    </div>
</div>

<div id="confirmModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-32 mx-auto p-6 w-11/12 md:w-96 shadow-lg rounded-xl bg-white text-center">
        <div class="w-14 h-14 bg-red-50 border-2 border-red-200 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </div>
        <p class="text-base font-bold text-gray-900 mb-2" id="confirmTitle">Remove this person?</p>
        <p class="text-sm text-gray-500 mb-6" id="confirmMsg">This will remove them from the chart.</p>
        <div class="flex gap-3 justify-center">
            <button onclick="document.getElementById('confirmModal').classList.add('hidden')" class="px-5 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium">Cancel</button>
            <button id="confirmDeleteBtn" class="inline-flex items-center gap-2 px-5 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium">Yes, Remove</button>
        </div>
    </div>
</div>

<div id="publishModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 overflow-y-auto h-full w-full z-50">
    <div class="relative top-6 mx-auto w-11/12 max-w-5xl shadow-2xl rounded-2xl bg-white overflow-hidden mb-8">

        <div class="bg-gradient-to-r from-red-800 to-red-600 px-6 py-4 flex justify-between items-center">
            <div>
                <h3 class="text-lg font-bold text-white">Preview &amp; Publish</h3>
                <p class="text-red-200 text-xs mt-0.5">Choose how the chart appears on the public website</p>
            </div>
            <button onclick="document.getElementById('publishModal').classList.add('hidden')"
                class="w-8 h-8 flex items-center justify-center rounded-lg bg-white/20 hover:bg-white/30 text-white">✕</button>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

                {{-- Style choices --}}
                <div class="lg:col-span-2">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-3">Display Style</p>
                    <div class="space-y-3" id="styleChoices">

                        <label class="style-choice selected" data-style="interactive">
                            <input type="radio" name="pubStyle" value="interactive" checked class="sr-only">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-lg bg-indigo-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Interactive Diagram</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Zoomable, pannable live chart. Visitors explore the full hierarchy.</p>
                                </div>
                            </div>
                        </label>

                        <label class="style-choice" data-style="cards">
                            <input type="radio" name="pubStyle" value="cards" class="sr-only">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-lg bg-teal-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Profile Cards Grid</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Clean photo cards grouped by unit. Mobile-friendly.</p>
                                </div>
                            </div>
                        </label>

                        <label class="style-choice" data-style="list">
                            <input type="radio" name="pubStyle" value="list" class="sr-only">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Directory List</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Compact list with name, role and unit. Easy to scan.</p>
                                </div>
                            </div>
                        </label>

                        <label class="style-choice" data-style="image">
                            <input type="radio" name="pubStyle" value="image" class="sr-only">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Static Image</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Display the uploaded chart image. Simple and fast.</p>
                                </div>
                            </div>
                        </label>

                    </div>

                    <button onclick="publishChart()"
                        class="w-full mt-5 inline-flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-red-700 to-red-600 hover:from-red-800 hover:to-red-700 text-white text-sm font-bold rounded-xl shadow transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Publish to Website
                    </button>
                    <p class="text-xs text-gray-400 text-center mt-2">Updates the public page immediately.</p>
                </div>

                <div class="lg:col-span-3">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Live Preview</p>
                        <div class="flex items-center gap-1 bg-gray-100 rounded-lg p-1">
                            <button onclick="setPreviewDevice('desktop')" id="prevDesktop" class="prev-dev-btn active p-1.5 rounded" title="Desktop">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </button>
                            <button onclick="setPreviewDevice('mobile')" id="prevMobile" class="prev-dev-btn p-1.5 rounded" title="Mobile">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="border border-gray-200 rounded-xl overflow-hidden shadow-md">
                        <div class="bg-gray-100 border-b border-gray-200 px-4 py-2.5 flex items-center gap-3">
                            <div class="flex gap-1.5 flex-shrink-0">
                                <div class="w-3 h-3 rounded-full bg-red-400"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                                <div class="w-3 h-3 rounded-full bg-green-400"></div>
                            </div>
                            <div class="flex-1 bg-white border border-gray-200 rounded-md px-3 py-1 text-xs text-gray-400 font-mono truncate">
                                pudho.gov.ph/organizational-structure
                            </div>
                        </div>
                        <div id="previewFrame" class="bg-white overflow-auto transition-all duration-300" style="height:400px;">
                            <div id="previewContent"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="toastWrap" class="fixed top-5 right-5 z-[999] flex flex-col gap-2 pointer-events-none"></div>

<style>
    .dir-btn {
        color: #6b7280;
        background: transparent;
        border: none;
        cursor: pointer;
    }
    .dir-btn.active {
        background: white;
        color: #1e293b;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
        border-radius: 6px;
    }
    .style-choice {
        display: block;
        padding: 12px 14px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        cursor: pointer;
        transition: all .15s;
    }
    .style-choice:hover {
        border-color: #fca5a5;
        background: #fff5f5;
    }
    .style-choice.selected {
        border-color: #b91c1c;
        background: #fff5f5;
    }

    .prev-dev-btn {
        color: #9ca3af;
        background: transparent;
        border: none;
        cursor: pointer;
        border-radius: 6px;
    }
    .prev-dev-btn.active {
        background: white;
        color: #1e293b;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    .pub-nav {
        background: linear-gradient(135deg, #7f1d1d, #b91c1c);
        padding: 12px 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .pub-nav-logo {
        width: 30px;
        height: 30px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .pub-nav-title {
        font-size: 13px;
        font-weight: 700;
        color: white;
    }
    .pub-nav-sub {
        font-size: 10px;
        color: rgba(255, 255, 255, 0.65);
    }
    .pub-page-header {
        padding: 14px 20px 10px;
        border-bottom: 1px solid #f3f4f6;
    }
    .pub-page-title {
        font-size: 17px;
        font-weight: 700;
        color: #111827;
    }
    .pub-page-sub {
        font-size: 11px;
        color: #6b7280;
        margin-top: 2px;
    }
    .preview-cards {
        padding: 10px 16px;
    }
    .preview-unit-label {
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #9ca3af;
        margin: 10px 0 6px;
    }
    .preview-cards-row {
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
    }
    .preview-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 10px 8px;
        width: 100px;
        text-align: center;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }
    .preview-card-av {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        margin: 0 auto 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 700;
        color: white;
    }
    .preview-card-name {
        font-size: 8.5px;
        font-weight: 700;
        color: #111827;
        line-height: 1.3;
    }
    .preview-card-role {
        font-size: 7.5px;
        color: #6b7280;
        margin-top: 2px;
    }

    .preview-list {
        padding: 6px 16px;
    }
    .preview-list-row {
        display: flex;
        align-items: center;
        gap: 7px;
        padding: 5px 6px;
        border-bottom: 1px solid #f3f4f6;
    }
    .preview-list-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        flex-shrink: 0;
    }
    .preview-list-name {
        font-size: 9.5px;
        font-weight: 600;
        color: #111827;
        flex: 1;
        min-width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .preview-list-role {
        font-size: 8.5px;
        color: #6b7280;
        min-width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .preview-list-unit {
        font-size: 7.5px;
        font-weight: 600;
        color: #5b21b6;
        background: #ede9fe;
        padding: 1px 5px;
        border-radius: 4px;
        white-space: nowrap;
    }
</style>

<script>
    let people = [{
            id: 1,
            name: 'HON. MARISOL ARAGONES SAMPELO',
            role: 'Provincial Administrator',
            level: 'top',
            unit: '',
            reportsTo: ''
        },
        {
            id: 2,
            name: 'ATTY. NATHALIE IRENE M. VELASQUEZ',
            role: 'Provincial Legal Administrator',
            level: 'director',
            unit: '',
            reportsTo: 'HON. MARISOL ARAGONES SAMPELO'
        },
        {
            id: 3,
            name: 'MANIFESTO A. FURED',
            role: 'Executive Director, Housing Authority',
            level: 'director',
            unit: '',
            reportsTo: 'ATTY. NATHALIE IRENE M. VELASQUEZ'
        },
        {
            id: 4,
            name: 'RECHEAL R. VILLAVECER',
            role: 'Administrative Assistant',
            level: 'staff',
            unit: '',
            reportsTo: 'MANIFESTO A. FURED'
        },
        {
            id: 5,
            name: 'JOHN CARLO C. MACDON',
            role: 'Law Staff',
            level: 'staff',
            unit: '',
            reportsTo: 'MANIFESTO A. FURED'
        },
        {
            id: 6,
            name: 'JOSEPHINE V. MIRANDA',
            role: 'Training & Records Mgmt. Staff',
            level: 'unit',
            unit: 'AGSU',
            reportsTo: 'MANIFESTO A. FURED'
        },
        {
            id: 7,
            name: 'MYRNA P. TANDANG',
            role: 'Administrative Staff',
            level: 'staff',
            unit: 'AGSU',
            reportsTo: 'JOSEPHINE V. MIRANDA'
        },
        {
            id: 8,
            name: 'JOSELITO S. CASTILLO',
            role: 'Administrative Staff',
            level: 'staff',
            unit: 'AGSU',
            reportsTo: 'JOSEPHINE V. MIRANDA'
        },
        {
            id: 9,
            name: 'RHODALYN N. CALINAGAN',
            role: 'Administrative Staff',
            level: 'staff',
            unit: 'AGSU',
            reportsTo: 'JOSEPHINE V. MIRANDA'
        },
        {
            id: 10,
            name: 'JINA S. DEL MUNDO',
            role: 'Administrative Staff',
            level: 'staff',
            unit: 'AGSU',
            reportsTo: 'JOSEPHINE V. MIRANDA'
        },
        {
            id: 11,
            name: 'HUBERT E. RICOHERMOSO',
            role: 'Administrative Staff',
            level: 'staff',
            unit: 'AGSU',
            reportsTo: 'JOSEPHINE V. MIRANDA'
        },
        {
            id: 12,
            name: 'ENGR. ROMULADO C. PALOMAR',
            role: 'Field Work Unit Head',
            level: 'unit',
            unit: 'OFWU',
            reportsTo: 'MANIFESTO A. FURED'
        },
        {
            id: 13,
            name: 'ANA KRISTINE C. ADAJAR',
            role: 'Field Staff III',
            level: 'staff',
            unit: 'OFWU',
            reportsTo: 'ENGR. ROMULADO C. PALOMAR'
        },
        {
            id: 14,
            name: 'SHARMANE JOY G. BIGAL',
            role: 'Field Staff II',
            level: 'staff',
            unit: 'OFWU',
            reportsTo: 'ENGR. ROMULADO C. PALOMAR'
        },
        {
            id: 15,
            name: 'CARLO F. OLIVAR',
            role: 'Field Staff - District IV-A',
            level: 'staff',
            unit: 'OFWU',
            reportsTo: 'ENGR. ROMULADO C. PALOMAR'
        },
        {
            id: 16,
            name: 'JESSICA JANE A. ELOMINA, ENP',
            role: 'Technical Unit Head',
            level: 'unit',
            unit: 'TSPU',
            reportsTo: 'MANIFESTO A. FURED'
        },
        {
            id: 17,
            name: 'MARIA SUSAN M. PASCUAL',
            role: 'Technical Staff II',
            level: 'staff',
            unit: 'TSPU',
            reportsTo: 'JESSICA JANE A. ELOMINA, ENP'
        },
        {
            id: 18,
            name: 'WENCY L. ABSULTO, ENP',
            role: 'Technical Staff III',
            level: 'staff',
            unit: 'TSPU',
            reportsTo: 'JESSICA JANE A. ELOMINA, ENP'
        },
        {
            id: 19,
            name: 'JEALYN C. MONTARDE, RSW',
            role: 'Institutional Relations Head',
            level: 'unit',
            unit: 'IRU',
            reportsTo: 'MANIFESTO A. FURED'
        },
        {
            id: 20,
            name: 'ROGIE C. BAGONGHASA',
            role: 'Media & Communications Head',
            level: 'unit',
            unit: 'MCU',
            reportsTo: 'MANIFESTO A. FURED'
        },
        {
            id: 21,
            name: 'AILEEN U. ZAIDE',
            role: 'Law Staff',
            level: 'staff',
            unit: 'MCU',
            reportsTo: 'ROGIE C. BAGONGHASA'
        },
        {
            id: 22,
            name: 'LEANNA JUNE A. TIONGSON',
            role: 'Law Staff',
            level: 'staff',
            unit: 'MCU',
            reportsTo: 'ROGIE C. BAGONGHASA'
        },
        {
            id: 23,
            name: 'WILSON D. MAGDAY',
            role: 'Law Staff',
            level: 'staff',
            unit: 'MCU',
            reportsTo: 'ROGIE C. BAGONGHASA'
        },
    ];

    let positions = [{
            id: 1,
            title: 'Executive Director',
            level: 'executive',
            responsibilities: ['Overall strategic leadership', 'Policy development', 'Stakeholder relations', 'Organizational oversight'],
            reportsTo: 'Board of Directors',
            updated: 'Feb 28, 2026'
        },
        {
            id: 2,
            title: 'Operations Manager',
            level: 'management',
            responsibilities: ['Daily operations', 'Team coordination', 'Process improvement', 'Performance monitoring'],
            reportsTo: 'Executive Director',
            updated: 'Mar 1, 2026'
        },
        {
            id: 3,
            title: 'Housing Officer',
            level: 'staff',
            responsibilities: ['Client assistance', 'Application processing', 'Document management', 'Public service'],
            reportsTo: 'Operations Manager',
            updated: 'Feb 25, 2026'
        },
    ];

    let nextPersonId = 30,
        nextPosId = 10;


    const LV = {
        top: {
            strip: '#7f1d1d',
            avBg: '#fecaca',
            avTxt: '#7f1d1d',
            label: 'TOP LEADERSHIP'
        },
        director: {
            strip: '#991b1b',
            avBg: '#fecaca',
            avTxt: '#7f1d1d',
            label: 'DIRECTOR'
        },
        unit: {
            strip: '#b45309',
            avBg: '#fef3c7',
            avTxt: '#78350f',
            label: 'UNIT HEAD'
        },
        staff: {
            strip: '#1d4ed8',
            avBg: '#dbeafe',
            avTxt: '#1e3a8a',
            label: 'STAFF'
        },
    };

    let chartDir = 'vertical';

    function setDirection(d) {
        chartDir = d;
        document.getElementById('btnVertical').classList.toggle('active', d === 'vertical');
        document.getElementById('btnHorizontal').classList.toggle('active', d === 'horizontal');
        reloadChart();
    }

    const NS = 'http://www.w3.org/2000/svg';
    const el = t => document.createElementNS(NS, t);

    const NW = 200,
        NH = 76,
        RX = 9,
        MGAP = 68,
        CGAP = 22,
        PAD = 36;

    function mkR(x, y, w, h, rx, fill, stroke, sw) {
        const r = el('rect');
        r.setAttribute('x', x);
        r.setAttribute('y', y);
        r.setAttribute('width', w);
        r.setAttribute('height', h);
        r.setAttribute('rx', rx);
        r.setAttribute('ry', rx);
        r.setAttribute('fill', fill);
        if (stroke) {
            r.setAttribute('stroke', stroke);
            r.setAttribute('stroke-width', sw || 1);
        }
        return r;
    }

    function mkT(x, y, t, sz, fw, fill, anch) {
        const e = el('text');
        e.setAttribute('x', x);
        e.setAttribute('y', y);
        e.setAttribute('font-size', sz);
        e.setAttribute('font-weight', fw);
        e.setAttribute('fill', fill);
        e.setAttribute('text-anchor', anch || 'start');
        e.setAttribute('font-family', 'Inter,system-ui,sans-serif');
        e.textContent = t;
        return e;
    }

    function clip(s, n) {
        return s.length > n ? s.slice(0, n - 1) + '…' : s;
    }

    function ini(name) {
        const p = name.replace(/^(HON\.|ATTY\.|ENGR\.)\s*/i, '').trim().split(' ');
        return ((p[0] || '')[0] || '').toUpperCase() + ((p[1] || '')[0] || '').toUpperCase();
    }

    function buildTree() {
        const map = {};
        people.forEach(p => {
            map[p.id] = {
                ...p,
                children: []
            };
        });
        const roots = [];
        people.forEach(p => {
            const par = Object.values(map).find(n => n.name === p.reportsTo);
            if (par) par.children.push(map[p.id]);
            else roots.push(map[p.id]);
        });
        return roots;
    }

    function span(node) {
        const self = chartDir === 'vertical' ? NW : NH;
        if (!node.children.length) return self;
        const s = node.children.reduce((acc, c) => acc + span(c) + CGAP, -CGAP);
        return Math.max(self, s);
    }

    function layout(node, maj, cross) {
        if (chartDir === 'vertical') {
            node._x = cross - NW / 2;
            node._y = maj;
        } else {
            node._x = maj;
            node._y = cross - NH / 2;
        }
        if (!node.children.length) return;
        const nodeSize = chartDir === 'vertical' ? NH : NW;
        const nextMaj = maj + nodeSize + MGAP;
        const tot = node.children.reduce((a, c) => a + span(c) + CGAP, -CGAP);
        let pos = (chartDir === 'vertical' ? cross : cross) - tot / 2;
        node.children.forEach(c => {
            const sp = span(c);
            layout(c, nextMaj, pos + sp / 2);
            pos += sp + CGAP;
        });
    }

    function drawCard(node, g) {
        const lv = LV[node.level] || LV.staff;
        const cg = el('g');
        cg.setAttribute('data-id', node.id);
        cg.style.cursor = 'pointer';

        cg.appendChild(mkR(node._x + 3, node._y + 4, NW, NH, RX, 'rgba(0,0,0,0.08)'));
        const bg = mkR(node._x, node._y, NW, NH, RX, 'white', '#e2e8f0', 1.5);
        cg.appendChild(bg);
        cg.appendChild(mkR(node._x, node._y, NW, 22, RX, lv.strip));
        cg.appendChild(mkR(node._x, node._y + 14, NW, 8, 0, lv.strip));
        cg.appendChild(mkT(node._x + NW / 2, node._y + 15, lv.label, 7, '600', 'rgba(255,255,255,0.8)', 'middle'));

        const av = el('circle');
        av.setAttribute('cx', node._x + 26);
        av.setAttribute('cy', node._y + 52);
        av.setAttribute('r', '14');
        av.setAttribute('fill', lv.avBg);
        av.setAttribute('stroke', 'white');
        av.setAttribute('stroke-width', '2');
        cg.appendChild(av);
        cg.appendChild(mkT(node._x + 26, node._y + 56, ini(node.name), 9.5, '700', lv.avTxt, 'middle'));

        const clean = node.name.replace(/^(HON\.|ATTY\.|ENGR\.)\s*/i, '').trim();
        const words = clean.split(' ');
        let L1 = '',
            L2 = '';
        words.forEach(w => {
            if ((L1 + ' ' + w).trim().length <= 20) L1 = (L1 + ' ' + w).trim();
            else L2 = (L2 + ' ' + w).trim();
        });
        if (!L2) {
            cg.appendChild(mkT(node._x + 48, node._y + 42, L1, 9.5, '700', '#1e293b'));
            cg.appendChild(mkT(node._x + 48, node._y + 56, clip(node.role, 25), 8, '400', '#64748b'));
        } else {
            cg.appendChild(mkT(node._x + 48, node._y + 38, L1, 9.5, '700', '#1e293b'));
            cg.appendChild(mkT(node._x + 48, node._y + 50, clip(L2, 20), 9.5, '700', '#1e293b'));
            cg.appendChild(mkT(node._x + 48, node._y + 62, clip(node.role, 25), 7.5, '400', '#64748b'));
        }
        if (node.unit) {
            cg.appendChild(mkR(node._x + NW - 44, node._y + NH - 14, 40, 11, 4, '#ede9fe'));
            cg.appendChild(mkT(node._x + NW - 24, node._y + NH - 6, node.unit, 7, '700', '#5b21b6', 'middle'));
        }

        cg.addEventListener('mouseenter', e => {
            bg.setAttribute('stroke', lv.strip);
            bg.setAttribute('stroke-width', '2.5');
            showPopup(e, node, lv);
        });
        cg.addEventListener('mouseleave', () => {
            bg.setAttribute('stroke', '#e2e8f0');
            bg.setAttribute('stroke-width', '1.5');
        });
        g.appendChild(cg);
        node.children.forEach(c => drawCard(c, g));
    }

    function drawLines(node, g) {
        node.children.forEach(c => {
            let d;
            if (chartDir === 'vertical') {
                const x1 = node._x + NW / 2,
                    y1 = node._y + NH,
                    x2 = c._x + NW / 2,
                    y2 = c._y,
                    my = (y1 + y2) / 2;
                d = `M${x1},${y1} C${x1},${my} ${x2},${my} ${x2},${y2}`;
            } else {
                const x1 = node._x + NW,
                    y1 = node._y + NH / 2,
                    x2 = c._x,
                    y2 = c._y + NH / 2,
                    mx = (x1 + x2) / 2;
                d = `M${x1},${y1} C${mx},${y1} ${mx},${y2} ${x2},${y2}`;
            }
            const path = el('path');
            path.setAttribute('d', d);
            path.setAttribute('fill', 'none');
            path.setAttribute('stroke', '#cbd5e1');
            path.setAttribute('stroke-width', '1.8');
            g.appendChild(path);

            const lvc = LV[c.level] || LV.staff;
            const dot = el('circle');
            dot.setAttribute('cx', chartDir === 'vertical' ? c._x + NW / 2 : c._x);
            dot.setAttribute('cy', chartDir === 'vertical' ? c._y : c._y + NH / 2);
            dot.setAttribute('r', '3');
            dot.setAttribute('fill', lvc.strip);
            g.appendChild(dot);
            drawLines(c, g);
        });
    }

    let panX = 0,
        panY = 0,
        scale = 1,
        panning = false,
        ps = {
            x: 0,
            y: 0
        };

    function renderOrgChart() {
        const rootG = document.getElementById('orgRoot');
        rootG.innerHTML = '';
        const roots = buildTree();
        let off = PAD;
        roots.forEach(r => {
            const sp = span(r);
            layout(r, PAD, off + sp / 2);
            off += sp + CGAP * 3;
        });
        let mx = 0,
            my = 0;

        function bnd(n) {
            mx = Math.max(mx, n._x + NW + PAD);
            my = Math.max(my, n._y + NH + PAD);
            n.children.forEach(bnd);
        }
        roots.forEach(bnd);

        const svg = document.getElementById('orgSvg');
        svg.setAttribute('width', mx);
        svg.setAttribute('height', my);

        const lg = el('g');
        roots.forEach(r => drawLines(r, lg));
        rootG.appendChild(lg);
        const cg = el('g');
        roots.forEach(r => drawCard(r, cg));
        rootG.appendChild(cg);

        const vp = document.getElementById('svgViewport');
        const vpW = vp.clientWidth || 640,
            vpH = vp.clientHeight || 560;
        scale = Math.min(1, (vpW - 16) / mx, (vpH - 16) / my);
        panX = (vpW - mx * scale) / 2;
        panY = 16;
        applyT();

        document.getElementById('chartLoader').style.display = 'none';
        document.getElementById('memberCount').textContent = people.length;
        document.getElementById('memberCountInfo').textContent = people.length + ' members';
    }

    function reloadChart() {
        document.getElementById('chartLoader').style.display = 'flex';
        setTimeout(renderOrgChart, 250);
    }

    function applyT() {
        document.getElementById('orgRoot').setAttribute('transform', `translate(${panX},${panY}) scale(${scale})`);
        document.getElementById('zoomLabel').textContent = Math.round(scale * 100) + '%';
    }

    function fitChart() {
        const svg = document.getElementById('orgSvg');
        const vp = document.getElementById('svgViewport');
        const vpW = vp.clientWidth || 640,
            vpH = vp.clientHeight || 560;
        const tw = +svg.getAttribute('width') || 900,
            th = +svg.getAttribute('height') || 560;
        scale = Math.min(1, (vpW - 16) / tw, (vpH - 16) / th);
        panX = (vpW - tw * scale) / 2;
        panY = 16;
        applyT();
    }

    function zoomIn() {
        scale = Math.min(2, +(scale + 0.1).toFixed(2));
        applyT();
    }

    function zoomOut() {
        scale = Math.max(0.2, +(scale - 0.1).toFixed(2));
        applyT();
    }

    (() => {
        const vp = document.getElementById('svgViewport');
        if (!vp) return;
        vp.addEventListener('mousedown', e => {
            if (e.target.closest('[data-id]')) return;
            panning = true;
            ps = {
                x: e.clientX - panX,
                y: e.clientY - panY
            };
            vp.style.cursor = 'grabbing';
        });
        window.addEventListener('mousemove', e => {
            if (!panning) return;
            panX = e.clientX - ps.x;
            panY = e.clientY - ps.y;
            applyT();
        });
        window.addEventListener('mouseup', () => {
            panning = false;
            const v = document.getElementById('svgViewport');
            if (v) v.style.cursor = 'grab';
        });
        vp.addEventListener('wheel', e => {
            e.preventDefault();
            scale = Math.min(2, Math.max(0.2, +(scale + (e.deltaY < 0 ? .08 : -.08)).toFixed(2)));
            applyT();
        }, {
            passive: false
        });
    })();

    function showPopup(e, node, lv) {
        lv = lv || LV[node.level] || LV.staff;
        const p = document.getElementById('nodePopup');
        document.getElementById('popupName').textContent = node.name;
        document.getElementById('popupRole').textContent = node.role;
        const av = document.getElementById('popupAvatar');
        av.textContent = ini(node.name);
        av.style.background = lv.strip;
        const b = document.getElementById('popupBadge');
        b.textContent = lv.label;
        b.style.background = lv.avBg;
        b.style.color = lv.avTxt;
        document.getElementById('popupEditBtn').onclick = () => {
            hidePopup();
            editPerson(node.id);
        };
        document.getElementById('popupDeleteBtn').onclick = () => {
            hidePopup();
            confirmDel(node.id, node.name);
        };
        p.style.left = Math.min(e.clientX + 16, window.innerWidth - 276) + 'px';
        p.style.top = Math.min(e.clientY - 8, window.innerHeight - 180) + 'px';
        p.classList.remove('hidden');
    }

    function hidePopup() {
        document.getElementById('nodePopup').classList.add('hidden');
    }
    document.addEventListener('click', e => {
        if (!e.target.closest('[data-id]') && !e.target.closest('#nodePopup')) hidePopup();
    });

    function openAddPersonModal() {
        document.getElementById('addPersonTitle').textContent = 'Add Person to Chart';
        document.getElementById('editPersonId').value = '';
        ['personName', 'personRole', 'personReportsTo'].forEach(id => document.getElementById(id).value = '');
        document.getElementById('personLevel').value = 'staff';
        document.getElementById('personUnit').value = '';
        document.getElementById('addPersonModal').classList.remove('hidden');
    }

    function editPerson(id) {
        const p = people.find(p => p.id === id);
        if (!p) return;
        document.getElementById('addPersonTitle').textContent = 'Edit Person';
        document.getElementById('editPersonId').value = id;
        document.getElementById('personName').value = p.name;
        document.getElementById('personRole').value = p.role;
        document.getElementById('personLevel').value = p.level;
        document.getElementById('personUnit').value = p.unit;
        document.getElementById('personReportsTo').value = p.reportsTo;
        document.getElementById('addPersonModal').classList.remove('hidden');
    }

    function savePerson() {
        const name = document.getElementById('personName').value.trim();
        const role = document.getElementById('personRole').value.trim();
        if (!name) {
            showToast('Please enter a full name.', 'error');
            return;
        }
        if (!role) {
            showToast('Please enter a position/role.', 'error');
            return;
        }
        const btn = document.getElementById('savePersonBtn');
        btn.innerHTML = '<span class="inline-block w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span> Saving…';
        btn.disabled = true;
        setTimeout(() => {
            const eid = +document.getElementById('editPersonId').value;
            const data = {
                name,
                role,
                level: document.getElementById('personLevel').value,
                unit: document.getElementById('personUnit').value,
                reportsTo: document.getElementById('personReportsTo').value.trim()
            };
            if (eid) Object.assign(people.find(p => p.id === eid), data);
            else people.push({
                id: nextPersonId++,
                ...data
            });
            btn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Save Person';
            btn.disabled = false;
            document.getElementById('addPersonModal').classList.add('hidden');
            showToast(eid ? 'Person updated!' : 'Person added to chart!', 'success');
            reloadChart();
        }, 700);
    }

    function confirmDel(id, name) {
        document.getElementById('confirmTitle').textContent = 'Remove "' + name.replace(/^(HON\.|ATTY\.|ENGR\.)\s*/i, '').trim() + '"?';
        document.getElementById('confirmMsg').textContent = 'This will remove them from the organizational chart.';
        document.getElementById('confirmDeleteBtn').onclick = () => deletePerson(id);
        document.getElementById('confirmModal').classList.remove('hidden');
    }

    function deletePerson(id) {
        const btn = document.getElementById('confirmDeleteBtn');
        btn.innerHTML = '<span class="inline-block w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span>';
        btn.disabled = true;
        setTimeout(() => {
            people = people.filter(p => p.id !== id);
            btn.innerHTML = 'Yes, Remove';
            btn.disabled = false;
            document.getElementById('confirmModal').classList.add('hidden');
            showToast('Person removed from chart.', 'success');
            reloadChart();
        }, 600);
    }

    function openPositionModal() {
        document.getElementById('posModalTitle').textContent = 'Add Position';
        document.getElementById('editPosId').value = '';
        ['posTitle', 'posResponsibilities', 'posReportsTo'].forEach(id => document.getElementById(id).value = '');
        document.getElementById('posLevel').value = 'staff';
        document.getElementById('positionModal').classList.remove('hidden');
    }

    function editPosition(id) {
        const pos = positions.find(p => p.id === id);
        if (!pos) return;
        document.getElementById('posModalTitle').textContent = 'Edit Position';
        document.getElementById('editPosId').value = id;
        document.getElementById('posTitle').value = pos.title;
        document.getElementById('posLevel').value = pos.level;
        document.getElementById('posResponsibilities').value = pos.responsibilities.join('\n');
        document.getElementById('posReportsTo').value = pos.reportsTo;
        document.getElementById('positionModal').classList.remove('hidden');
    }

    function savePosition() {
        const title = document.getElementById('posTitle').value.trim();
        if (!title) {
            showToast('Please enter a position title.', 'error');
            return;
        }
        const resp = document.getElementById('posResponsibilities').value.split('\n').map(r => r.replace(/^[•\-\*]\s*/, '')).filter(Boolean);
        const data = {
            title,
            level: document.getElementById('posLevel').value,
            responsibilities: resp,
            reportsTo: document.getElementById('posReportsTo').value.trim(),
            updated: new Date().toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            })
        };
        const eid = +document.getElementById('editPosId').value;
        if (eid) Object.assign(positions.find(p => p.id === eid), data);
        else positions.push({
            id: nextPosId++,
            ...data
        });
        showToast(eid ? 'Position updated!' : 'Position added!', 'success');
        document.getElementById('positionModal').classList.add('hidden');
        renderPositions();
    }

    function deletePosition(id) {
        positions = positions.filter(p => p.id !== id);
        renderPositions();
        showToast('Position deleted.', 'success');
    }

    function renderPositions() {
        const grid = document.getElementById('positionsGrid');
        grid.innerHTML = '';
        const hM = {
            executive: 'bg-gradient-to-r from-red-800 to-red-900',
            management: 'bg-gradient-to-r from-red-600 to-red-700',
            staff: 'bg-gradient-to-r from-red-500 to-red-600'
        };
        const lM = {
            executive: 'Executive Level',
            management: 'Management Level',
            staff: 'Staff Level'
        };
        positions.forEach(pos => {
            const card = document.createElement('div');
            card.className = 'border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow';
            card.innerHTML = `<div class="px-4 py-3 ${hM[pos.level]||hM.staff}"><h4 class="font-semibold text-white text-sm">${pos.title}</h4><p class="text-red-200 text-xs mt-0.5">${lM[pos.level]||pos.level}</p></div>
        <div class="p-4"><p class="text-xs text-gray-600 mb-2">Responsibilities:</p><ul class="text-sm text-gray-700 space-y-1 mb-3">${pos.responsibilities.map(r=>`<li class="flex gap-1.5"><span class="text-gray-400">•</span>${r}</li>`).join('')}</ul>
        <p class="text-xs text-gray-600 mb-1">Reports to:</p><p class="text-sm font-medium text-gray-800 mb-3">${pos.reportsTo||'—'}</p>
        <div class="flex justify-between items-center"><span class="text-xs text-gray-400">Updated: ${pos.updated}</span>
        <div class="flex gap-1">
        <button onclick="editPosition(${pos.id})" class="p-1.5 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
        <button onclick="deletePosition(${pos.id})" class="p-1.5 text-red-600 hover:text-red-800 hover:bg-red-50 rounded transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
        </div></div></div>`;
            grid.appendChild(card);
        });
    }

    function downloadChart() {
        showToast('Download started!', 'success');
    }

    function viewVersions() {
        showToast('Version history coming soon.', 'info');
    }

    function fakeReplaceChart() {
        document.getElementById('replaceModal').classList.add('hidden');
        showToast('Chart replaced successfully!', 'success');
    }
    document.getElementById('chartReplaceFile').addEventListener('change', function() {
        if (!this.files.length) return;
        const r = new FileReader();
        r.onload = e => {
            document.getElementById('replacePreviewImg').src = e.target.result;
            document.getElementById('replacePreviewWrap').classList.remove('hidden');
        };
        r.readAsDataURL(this.files[0]);
    });

    let pubStyle = 'interactive',
        prevDev = 'desktop';

    function openPublishModal() {
        document.getElementById('publishModal').classList.remove('hidden');
        renderPreview();
    }

    document.querySelectorAll('.style-choice').forEach(e => {
        e.addEventListener('click', () => {
            document.querySelectorAll('.style-choice').forEach(x => x.classList.remove('selected'));
            e.classList.add('selected');
            pubStyle = e.dataset.style;
            renderPreview();
        });
    });

    function setPreviewDevice(d) {
        prevDev = d;
        document.getElementById('prevDesktop').classList.toggle('active', d === 'desktop');
        document.getElementById('prevMobile').classList.toggle('active', d === 'mobile');
        const f = document.getElementById('previewFrame');
        f.style.maxWidth = d === 'mobile' ? '375px' : '100%';
        f.style.margin = d === 'mobile' ? '0 auto' : '0';
        renderPreview();
    }

    function pubNav() {
        return `<div class="pub-nav"><div class="pub-nav-logo"><svg width="14" height="14" fill="white" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg></div><div><div class="pub-nav-title">LAGUNA PUDHO</div><div class="pub-nav-sub">Urban Development &amp; Housing</div></div></div>
    <div class="pub-page-header"><div class="pub-page-title">Organizational Structure</div><div class="pub-page-sub">Provincial Urban Development &amp; Housing Office</div></div>`;
    }

    function renderPreview() {
        const mob = prevDev === 'mobile';
        let html = pubNav();

        if (pubStyle === 'interactive') {
            html += `<div style="padding:10px 16px;">
            <p style="font-size:11px;color:#6b7280;margin-bottom:8px;">Interactive chart — visitors can zoom and pan to explore the full hierarchy.</p>
            <div style="border:1px solid #e5e7eb;border-radius:8px;background:#f9fafb;overflow:hidden;height:200px;position:relative;display:flex;align-items:center;justify-content:center;">
                <div style="position:absolute;inset:0;overflow:hidden;">
                    <div style="transform:scale(0.32);transform-origin:top left;padding:8px;">${buildMiniChart()}</div>
                </div>
                <div style="position:absolute;bottom:8px;right:8px;background:rgba(0,0,0,0.45);color:white;font-size:9px;padding:3px 8px;border-radius:4px;">🔍 Zoom &amp; Pan</div>
            </div>
        </div>`;

        } else if (pubStyle === 'cards') {
            const units = ['', 'AGSU', 'OFWU', 'TSPU', 'IRU', 'MCU'];
            const uN = {
                '': 'Leadership',
                'AGSU': 'Admin &amp; General Services',
                'OFWU': 'Operations &amp; Field Work',
                'TSPU': 'Technical &amp; Special Project',
                'IRU': 'Institutional Relations',
                'MCU': 'Media &amp; Communications'
            };
            html += `<div class="preview-cards">`;
            units.forEach(u => {
                const grp = people.filter(p => p.unit === u).slice(0, mob ? 2 : 4);
                if (!grp.length) return;
                html += `<div class="preview-unit-label">${uN[u]||u}</div><div class="preview-cards-row">`;
                grp.forEach(p => {
                    const lv = LV[p.level] || LV.staff;
                    const clean = p.name.replace(/^(HON\.|ATTY\.|ENGR\.)\s*/i, '').trim();
                    html += `<div class="preview-card"><div class="preview-card-av" style="background:${lv.strip};">${ini(p.name)}</div><div class="preview-card-name">${clip(clean,16)}</div><div class="preview-card-role">${clip(p.role,18)}</div></div>`;
                });
                html += `</div>`;
            });
            html += `</div>`;

        } else if (pubStyle === 'list') {
            const shown = mob ? 6 : 10;
            html += `<div class="preview-list"><div style="display:flex;justify-content:space-between;padding:5px 6px;border-bottom:2px solid #f3f4f6;margin-bottom:3px;"><span style="font-size:8.5px;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px">Name &amp; Role</span><span style="font-size:8.5px;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px">Unit</span></div>`;
            people.slice(0, shown).forEach(p => {
                const lv = LV[p.level] || LV.staff;
                const clean = p.name.replace(/^(HON\.|ATTY\.|ENGR\.)\s*/i, '').trim();
                html += `<div class="preview-list-row"><div class="preview-list-dot" style="background:${lv.strip}"></div><div class="preview-list-name">${clip(clean,20)}</div><div class="preview-list-role">${clip(p.role,18)}</div>${p.unit?`<div class="preview-list-unit">${p.unit}</div>`:''}</div>`;
            });
            if (people.length > shown) html += `<div style="text-align:center;padding:7px;font-size:10px;color:#9ca3af;">+${people.length-shown} more members</div>`;
            html += `</div>`;

        } else {
            html += `<div style="padding:16px;text-align:center;">
            <div style="width:100%;height:190px;background:linear-gradient(135deg,#fee2e2,#fef2f2);border-radius:8px;display:flex;align-items:center;justify-content:center;border:1px dashed #fca5a5;">
                <div><svg width="36" height="36" fill="none" stroke="#fca5a5" viewBox="0 0 24 24" style="margin:0 auto 7px;display:block;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <p style="font-size:11px;color:#9ca3af;">Organizational Chart Image</p>
                <p style="font-size:9px;color:#d1d5db;margin-top:3px;">Upload via "Replace Image"</p></div>
            </div>
        </div>`;
        }

        document.getElementById('previewContent').innerHTML = html;
    }

    function buildMiniChart() {
        const sub = people.filter(p => ['top', 'director'].includes(p.level)).slice(0, 3);
        const map = {};
        sub.forEach(p => {
            map[p.id] = {
                ...p,
                children: []
            };
        });
        const roots = [];
        sub.forEach(p => {
            const par = Object.values(map).find(n => n.name === p.reportsTo);
            if (par) par.children.push(map[p.id]);
            else roots.push(map[p.id]);
        });
        const mNW = 160,
            mNH = 46,
            mRX = 6,
            mV = 36,
            mH = 12,
            mP = 8;

        function mSpan(n) {
            if (!n.children.length) return mNW;
            const t = n.children.reduce((s, c) => s + mSpan(c) + mH, -mH);
            return Math.max(mNW, t);
        }

        function mLay(n, maj, cross) {
            n._x = cross - mNW / 2;
            n._y = maj;
            if (!n.children.length) return;
            const t = n.children.reduce((s, c) => s + mSpan(c) + mH, -mH);
            let x = cross - t / 2;
            n.children.forEach(c => {
                const w = mSpan(c);
                mLay(c, maj + mNH + mV, x + w / 2);
                x += w + mH;
            });
        }
        let off = mP;
        roots.forEach(r => {
            const w = mSpan(r);
            mLay(r, mP, off + w / 2);
            off += w + mH * 2;
        });
        let mx = 0,
            my = 0;

        function bnd(n) {
            mx = Math.max(mx, n._x + mNW + mP);
            my = Math.max(my, n._y + mNH + mP);
            n.children.forEach(bnd);
        }
        roots.forEach(bnd);
        let out = `<svg width="${mx}" height="${my}" xmlns="http://www.w3.org/2000/svg">`;

        function mLns(n) {
            n.children.forEach(c => {
                const x1 = n._x + mNW / 2,
                    y1 = n._y + mNH,
                    x2 = c._x + mNW / 2,
                    y2 = c._y,
                    my2 = (y1 + y2) / 2;
                out += `<path d="M${x1},${y1} C${x1},${my2} ${x2},${my2} ${x2},${y2}" fill="none" stroke="#cbd5e1" stroke-width="1.2"/>`;
                mLns(c);
            });
        }
        roots.forEach(r => mLns(r));

        function mCd(n) {
            const lv = LV[n.level] || LV.staff;
            const clean = n.name.replace(/^(HON\.|ATTY\.|ENGR\.)\s*/i, '').trim();
            out += `<rect x="${n._x+2}" y="${n._y+2}" width="${mNW}" height="${mNH}" rx="${mRX}" fill="rgba(0,0,0,0.07)"/>`;
            out += `<rect x="${n._x}" y="${n._y}" width="${mNW}" height="${mNH}" rx="${mRX}" fill="white" stroke="#e2e8f0" stroke-width="1"/>`;
            out += `<rect x="${n._x}" y="${n._y}" width="${mNW}" height="13" rx="${mRX}" fill="${lv.strip}"/>`;
            out += `<rect x="${n._x}" y="${n._y+7}" width="${mNW}" height="6" fill="${lv.strip}"/>`;
            out += `<circle cx="${n._x+15}" cy="${n._y+31}" r="9" fill="${lv.avBg}" stroke="white" stroke-width="1.5"/>`;
            out += `<text x="${n._x+15}" y="${n._y+35}" font-size="7" font-weight="700" fill="${lv.avTxt}" text-anchor="middle" font-family="Inter,sans-serif">${ini(n.name)}</text>`;
            out += `<text x="${n._x+30}" y="${n._y+29}" font-size="7.5" font-weight="700" fill="#1e293b" font-family="Inter,sans-serif">${clip(clean,17)}</text>`;
            out += `<text x="${n._x+30}" y="${n._y+40}" font-size="6.5" fill="#94a3b8" font-family="Inter,sans-serif">${clip(n.role,22)}</text>`;
            n.children.forEach(mCd);
        }
        roots.forEach(r => mCd(r));
        out += `</svg>`;
        return out;
    }

    function publishChart() {
        const labels = {
            interactive: 'Interactive Diagram',
            cards: 'Profile Cards Grid',
            list: 'Directory List',
            image: 'Static Image'
        };
        document.getElementById('publishModal').classList.add('hidden');
        showToast(`Published as "${labels[pubStyle]}"!`, 'success');
    }

    function showNotification(msg, type) {
        showToast(msg, type);
    }

    function showToast(msg, type = 'success') {
        const c = {
            success: 'bg-green-500',
            error: 'bg-red-500',
            info: 'bg-blue-500'
        };
        const ic = {
            success: '✓',
            error: '✕',
            info: 'ℹ'
        };
        const t = document.createElement('div');
        t.className = `flex items-center gap-2 px-4 py-3 rounded-lg shadow-lg text-white text-sm font-medium pointer-events-auto ${c[type]||c.info} opacity-0 transition-opacity duration-300`;
        t.innerHTML = `<span>${ic[type]||'ℹ'}</span><span>${msg}</span>`;
        document.getElementById('toastWrap').appendChild(t);
        requestAnimationFrame(() => {
            t.style.opacity = '1';
        });
        setTimeout(() => {
            t.style.opacity = '0';
            setTimeout(() => t.remove(), 300);
        }, 3000);
    }

    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            renderOrgChart();
            renderPositions();
        }, 300);
    });
</script>
@endsection