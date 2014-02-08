MageFM Customer
===============

Magento Customer customization that allows gather data specific for brazilian customers.

Installation
------------

Copy all files from this module over your Magento installation. Required database
changes will be executed automatically after cache cleanup.

Template changes
----------------

* This module includes jQuery 1.10.2 automatically. If you already include it,
please remove from `app/design/frontend/base/default/layout/magefm_customer.xml`.

* This module make several changes to `base/default` phtml files, in order to
include the necessary changes. If you in any way extends or modify those files,
please take a look on project source before installing the module.