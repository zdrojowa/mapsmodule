<?php

namespace Selene\Modules\MapsModule\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Selene\Modules\DashboardModule\ZdrojowaTable;
use Selene\Modules\MapsModule\Http\Requests\HotelsLocalizationStoreRequest;
use Selene\Modules\MapsModule\Models\HotelsLocalization;
use Selene\modules\MapsModule\src\Support\HotelsStatusesEnum;

/**
 * Class MapsController
 * @package Selene\Modules\MapsModule\Http\Controllers
 */
class MapsController extends Controller
{
    public function index()
    {
        return view('MapsModule::list');
    }

    public function ajax(Request $request): JsonResponse
    {
        return ZdrojowaTable::response(HotelsLocalization::query(), $request);
    }

    public function create()
    {
        return view('MapsModule::edit', ['statuses' => HotelsStatusesEnum::toArray()]);
    }

    public function edit(HotelsLocalization $hotel = null)
    {
        return view('MapsModule::edit', ['hotel' => $hotel, 'statuses' => HotelsStatusesEnum::toArray()]);
    }

    public function store(HotelsLocalizationStoreRequest $request): RedirectResponse
    {
        $hotel = $this->save($request);
        if ($hotel) {
            $request->session()->flash('alert-success', 'Hotel dodano pomyślnie do map.');
            return redirect()->route('MapsModule::maps.edit', ['hotel' => $hotel]);
        }

        $request->session()->flash('alert-error', 'Ooops. Try again.');
        return redirect()->back();
    }

    public function update(HotelsLocalizationStoreRequest $request, HotelsLocalization $hotel): RedirectResponse
    {
        if ($this->save($request, $hotel)) {
            $request->session()->flash('alert-success', 'Hotel został pomyślnie zaktualizowany.');
        } else {
            $request->session()->flash('alert-error', 'Ooops. Try again.');
        }

        return redirect()->back();
    }

    private function save(HotelsLocalizationStoreRequest $request, HotelsLocalization $hotel = null) {

        $images = ['photo', 'logo'];
        foreach ($images as $image) {
            if ($request->has($image . '_file')) {

                $photo    = $request->file($image . '_file');
                $filename = md5(uniqid($photo->getClientOriginalName(), true));
                $path     = $photo->move(
                    'storage/hotels/',
                    $filename . '.' . $photo->getClientOriginalExtension()
                )->getPathName();

                $request->merge([$image => $path]);
            }
        }

        if ($hotel === null) {
            return HotelsLocalization::create($request->all());
        }

        return $hotel->update($request->all());
    }

    public function destroy(HotelsLocalization $hotel, Request $request): void
    {
        try {
            $hotel->delete();
            $request->session()->flash('alert-success', 'Hotel is deleted');
        } catch (Exception $e) {
            $request->session()->flash('alert-error', 'Error: ' . $e->getMessage());
        }
    }

    public function getAll(): JsonResponse
    {
        return response()->json(HotelsLocalization::all()->toArray());
    }
}
