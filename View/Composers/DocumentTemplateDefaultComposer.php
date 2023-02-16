<?php

namespace Modules\HagitCust\View\Composers;

use Illuminate\View\View;

class DocumentTemplateDefaultComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $view->setPath(view('hagit-cust::components.documents.template.default')->getPath());
    }
}