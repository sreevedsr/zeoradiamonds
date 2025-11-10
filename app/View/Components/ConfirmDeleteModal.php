<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ConfirmDeleteModal extends Component
{
    public string $message;
    public string $action;
    public string $title;

    public function __construct(
        string $action,
        string $message = 'Are you sure you want to delete this item? This action cannot be undone.',
        string $title = 'Confirm Deletion'
    ) {
        $this->action = $action;
        $this->message = $message;
        $this->title = $title;
    }

    public function render()
    {
        return view('components.confirm-delete-modal');
    }
}
