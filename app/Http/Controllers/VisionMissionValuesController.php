<?php

namespace App\Http\Controllers;

use App\Models\Vision;
use App\Models\MissionStatement;
use App\Models\CoreValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisionMissionValuesController extends Controller
{
    public function index()
    {
        // Load active content
        $vision = Vision::where('is_active', true)->latest()->first();
        $mission = MissionStatement::where('is_active', true)->latest()->first();

        // Load active core values
        $coreValues = CoreValue::where('is_active', true)
            ->orderBy('order')
            ->get();

        // Get version histories
        $visionHistory = Vision::orderBy('created_at', 'desc')->limit(10)->get();
        $missionHistory = MissionStatement::orderBy('created_at', 'desc')->limit(10)->get();
        $valuesHistory = CoreValue::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('editor.vision-mission-values', compact(
            'vision',
            'mission',
            'coreValues',
            'visionHistory',
            'missionHistory',
            'valuesHistory'
        ));
    }

    public function saveVision(Request $request)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        // Deactivate old versions
        Vision::where('is_active', true)->update(['is_active' => false]);

        // Create new version
        $vision = Vision::create([
            'content' => $request->content,
            'author_id' => Auth::id(),
            'published_at' => now(),
            'is_active' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Vision statement saved successfully',
            'data' => [
                'id' => $vision->id,
                'updated_at' => $vision->updated_at->format('F j, Y \a\t g:i A'),
                'author' => Auth::user()->name,
                'content' => $vision->content
            ]
        ]);
    }

    public function saveMission(Request $request)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        // Deactivate old versions
        MissionStatement::where('is_active', true)->update(['is_active' => false]);

        // Create new version
        $mission = MissionStatement::create([
            'content' => $request->content,
            'author_id' => Auth::id(),
            'published_at' => now(),
            'is_active' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Mission statement saved successfully',
            'data' => [
                'id' => $mission->id,
                'updated_at' => $mission->updated_at->format('F j, Y \a\t g:i A'),
                'author' => Auth::user()->name,
                'content' => $mission->content
            ]
        ]);
    }

    public function saveCoreValues(Request $request)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        // Parse HTML content to extract core values
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML(mb_convert_encoding($request->content, 'HTML-ENTITIES', 'UTF-8'));
        libxml_clear_errors();

        $lis = $dom->getElementsByTagName('li');
        $values = [];

        foreach ($lis as $li) {
            $text = $li->textContent;
            if (preg_match('/^(.*?)\s*[–\-]\s*(.*)$/', $text, $matches)) {
                $values[] = [
                    'title' => trim($matches[1]),
                    'content' => trim($matches[2])
                ];
            } else {
                $values[] = [
                    'title' => 'Value',
                    'content' => trim($text)
                ];
            }
        }

        // Deactivate old versions
        CoreValue::where('is_active', true)->update(['is_active' => false]);

        // Create new versions
        foreach ($values as $index => $value) {
            CoreValue::create([
                'content' => $value['content'],
                'author_id' => Auth::id(),
                'value_title' => $value['title'],
                'order' => $index,
                'published_at' => now(),
                'is_active' => true,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Core values saved successfully',
            'data' => [
                'updated_at' => now()->format('F j, Y \a\t g:i A'),
                'author' => Auth::user()->name,
                'content' => $request->content
            ]
        ]);
    }

    public function getVersion($type, $id)
    {
        $content = null;

        switch ($type) {
            case 'vision':
                $vision = Vision::find($id);
                if ($vision) $content = $vision->content;
                break;
            case 'mission':
                $mission = MissionStatement::find($id);
                if ($mission) $content = $mission->content;
                break;
            case 'values':
                $values = CoreValue::where('is_active', false)
                    ->where('id', $id)
                    ->first();
                if ($values) $content = "<strong>{$values->value_title}</strong> – {$values->content}";
                break;
        }

        return response()->json([
            'success' => true,
            'content' => $content
        ]);
    }

    public function restoreVersion(Request $request)
    {
        try {
            $request->validate([
                'type' => 'required|in:vision,mission,values',
                'content' => 'required|string'
            ]);

            switch ($request->type) {
                case 'vision':
                    // Deactivate old versions
                    Vision::where('is_active', true)->update(['is_active' => false]);

                    // Create new version from restored content
                    $vision = Vision::create([
                        'content' => $request->content,
                        'author_id' => Auth::id(),
                        'published_at' => now(),
                        'is_active' => true,
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Vision statement restored successfully',
                        'data' => [
                            'id' => $vision->id,
                            'content' => $vision->content,
                            'updated_at' => $vision->updated_at->format('F j, Y \a\t g:i A'),
                            'author' => Auth::user()->name
                        ]
                    ]);

                case 'mission':
                    // Deactivate old versions
                    MissionStatement::where('is_active', true)->update(['is_active' => false]);

                    // Create new version from restored content
                    $mission = MissionStatement::create([
                        'content' => $request->content,
                        'author_id' => Auth::id(),
                        'published_at' => now(),
                        'is_active' => true,
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Mission statement restored successfully',
                        'data' => [
                            'id' => $mission->id,
                            'content' => $mission->content,
                            'updated_at' => $mission->updated_at->format('F j, Y \a\t g:i A'),
                            'author' => Auth::user()->name
                        ]
                    ]);

                case 'values':
                    // Deactivate old versions
                    CoreValue::where('is_active', true)->update(['is_active' => false]);

                    // Parse content to extract core values
                    $dom = new \DOMDocument();
                    libxml_use_internal_errors(true);
                    $dom->loadHTML(mb_convert_encoding($request->content, 'HTML-ENTITIES', 'UTF-8'));
                    libxml_clear_errors();

                    $lis = $dom->getElementsByTagName('li');
                    $values = [];

                    foreach ($lis as $index => $li) {
                        $text = $li->textContent;
                        if (preg_match('/^(.*?)\s*[–\-]\s*(.*)$/', $text, $matches)) {
                            $values[] = [
                                'title' => trim($matches[1]),
                                'content' => trim($matches[2])
                            ];
                        } else {
                            $values[] = [
                                'title' => 'Value',
                                'content' => trim($text)
                            ];
                        }
                    }

                    // Create new versions
                    foreach ($values as $index => $value) {
                        CoreValue::create([
                            'content' => $value['content'],
                            'author_id' => Auth::id(),
                            'value_title' => $value['title'],
                            'order' => $index,
                            'published_at' => now(),
                            'is_active' => true,
                        ]);
                    }

                    return response()->json([
                        'success' => true,
                        'message' => 'Core values restored successfully',
                        'data' => [
                            'content' => $request->content,
                            'updated_at' => now()->format('F j, Y \a\t g:i A'),
                            'author' => Auth::user()->name
                        ]
                    ]);
            }

            return response()->json(['success' => false, 'message' => 'Invalid type'], 400);
        } catch (\Exception $e) {
            \Log::error('Restore error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error restoring version: ' . $e->getMessage()
            ], 500);
        }
    }
}
