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
use Phalcon\Security;
use Phalcon\Validation\Validator\Identical;

/**
 * @property Security $security
 */
abstract class FormBase extends Form
{

    // CSRF name
    const CSRF_NAME = 'csrf';

    /**
     * Constructor
     */
    public function __construct($gerenateCsrf = true)
    {
        parent::__construct();
        
        $this->assignCsrf($gerenateCsrf);
    }

    /**
     * Assign Csrf
     * 
     * @param bool $gerenateCsrf Should csrf be generated
     * 
     * @return void
     */
    private function assignCsrf($gerenateCsrf) {
        $csrf = new Hidden(self::CSRF_NAME);

        if($gerenateCsrf) {
            $csrf->setDefault($this->security->getToken());
        }

        $csrf->addValidator(new Identical(array(
            'value' => $this->security->getSessionToken(),
            'message' => 'Invalid Form'
        )));

        $this->add($csrf);
    }
}
