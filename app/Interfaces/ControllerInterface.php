<?php

namespace App\Interfaces;

use App\Lib\Request;


interface ControllerInterface
{
    public function index(Request $request): mixed;
    public function show(Request $request): mixed;
    public function store(Request $request): mixed;
    public function update(Request $request): mixed;
    public function destroy(Request $request): mixed;
}
