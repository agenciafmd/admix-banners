<?php

namespace Agenciafmd\Banners\Livewire\Pages\Banner;

use Agenciafmd\Banners\Models\Banner;
use Agenciafmd\Ui\Traits\WithMediaSync;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Livewire\Component as LivewireComponent;
use Livewire\Features\SupportRedirects\Redirector;
use Livewire\WithFileUploads;

class Component extends LivewireComponent
{
    use AuthorizesRequests, WithFileUploads, WithMediaSync;

    public Form $form;

    public Banner $banner;

    public array $targetOptions;

    public string $location;

    public function mount(Banner $banner): void
    {
        ($banner->exists) ? $this->authorize('update', Banner::class) : $this->authorize('create', Banner::class);

        $this->banner = $banner;
        $this->location = ($banner->exists) ? $this->banner->location : request()->route()?->parameter('location');
        $this->form->setModel($banner, $this->location);
        $this->targetOptions = $this->getTargetOptions();
    }

    public function submit(): null|Redirector|RedirectResponse
    {
        try {
            if ($this->form->save()) {
                flash(($this->banner->exists) ? __('crud.success.save') : __('crud.success.store'), 'success');
            } else {
                flash(__('crud.error.save'), 'error');
            }

            return redirect()->to(session()->get('backUrl') ?: route('admix.banners.index'));
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            $this->dispatch(event: 'toast', level: 'danger', message: $exception->getMessage());
        }

        return null;
    }

    public function render(): View
    {
        return view('admix-banners::pages.banner.form')
            ->extends('admix::internal')
            ->section('internal-content');
    }

    private function getTargetOptions(): array
    {
        return [
            [
                'label' => '-',
                'value' => '',
            ],
            [
                'label' => 'na mesma página',
                'value' => '_self',
            ],
            [
                'label' => 'em uma nova janela',
                'value' => '_blank',
            ],
        ];
    }
}
