<?php

/**
 * This file is part of the Phlexus CMS.
 *
 * (c) Phlexus CMS <cms@phlexus.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Phlexus\Form;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\Identical;

abstract class FormBase extends Form
{
    public function initialize()
    {
        $csrf = new Hidden($this->getCsrfName());

        $csrf->setDefault($this->security->getToken())
            ->addValidator(new Identical([
                'value' => $this->security->getRequestToken(),
                'message' => 'Invalid request'
            ]));

        $this->add($csrf);
    }

    public function getCsrfName(): string
    {
        return $this->security->getToken();
    }
}
