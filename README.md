Semaio_SearchSkuRedirect
========================

Redirect a SKU search in Magento to the corresponding product.

Build Status
------------
* Latest Release: [![Master Branch](https://travis-ci.org/semaio/Magento1-SearchSkuRedirect.svg?branch=master)](https://travis-ci.org/semaio/Magento1-SearchSkuRedirect)
* Development Branch: [![Develop Branch](https://travis-ci.org/semaio/Magento1-SearchSkuRedirect.svg?branch=develop)](https://travis-ci.org/semaio/Magento1-SearchSkuRedirect)

Functionality
-------------

If a customer searchs within the default Magento search for a specific SKU, this module will redirect the customer 
to the specific product, if the product is enabled and visible in catalog and/or search.

If the found product is a *Simple Product* with the visibilty *Individually not visible*, this module tries to find
a related parent product (*Grouped Product* or *Configurable Product*). If the found parent product is enabled and
visible in catalog and/or search, the customer will be redirected to the parent product.

Support
-------
If you encounter any problems or bugs, please create an issue on [GitHub](https://github.com/semaio/Magento1-SearchSkuRedirect/issues).

Contribution
------------
Any contribution to the development of MageSetup is highly welcome. The best possibility to provide any code is to open a [pull request on GitHub](https://help.github.com/articles/using-pull-requests).

Licence
-------
[Open Software License (OSL 3.0)](http://opensource.org/licenses/osl-3.0.php)

Copyright
---------
(c) 2016 Rouven Alexander Rieker
