<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class ConfigController extends Controller
{
    private static $editableEnv = [
        'hostname' => 'DB_HOST',
        'port'     => 'DB_PORT',
        'database' => 'DB_DATABASE',
        'username' => 'DB_USERNAME',
        'password' => 'DB_PASSWORD',
    ];

    private function envValues()
    {
        $env = DotenvEditor::load();
        $out = [];
        foreach ($this::$editableEnv as $key => $value) {
            $out[$key] = $env->getValue($value);
        }
        return $out;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Database settings
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function database(): Renderable
    {
        $data = $this->envValues();
        return view('admin.config.database', $data);
    }

    /**
     * Database settings
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function letterboxd(): Renderable
    {
        return view('admin.config.letterboxd');
    }

    public function store(Request $request): RedirectResponse
    {
        $env = DotenvEditor::load();
        foreach ($this::$editableEnv as $localKey => $envKey) {
            if ($request->input($localKey)) $env->setKey($envKey, $request->input($localKey));
        }
        $env->save();
        return redirect()->route($request->input('_redirectTo') ?? 'config.app')->with('success', __('config.commons.messages.success_save'));
    }
}
