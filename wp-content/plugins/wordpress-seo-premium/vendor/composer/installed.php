<?php return array(
    'root' => array(
        'pretty_version' => 'dev-master',
        'version' => 'dev-master',
        'type' => 'wordpress-plugin',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'reference' => '8241c83aa3922ccba9b5935b65fd35db9ace1ddf',
        'name' => 'yoast/wordpress-seo-premium',
        'dev' => true,
    ),
    'versions' => array(
        'antecedent/patchwork' => array(
            'pretty_version' => '2.1.12',
            'version' => '2.1.12.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../antecedent/patchwork',
            'aliases' => array(),
            'reference' => 'b98e046dd4c0acc34a0846604f06f6111654d9ea',
            'dev_requirement' => true,
        ),
        'brain/monkey' => array(
            'pretty_version' => '2.6.0',
            'version' => '2.6.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../brain/monkey',
            'aliases' => array(),
            'reference' => '7042140000b4b18034c0c0010d86274a00f25442',
            'dev_requirement' => true,
        ),
        'composer/installers' => array(
            'pretty_version' => 'v1.10.0',
            'version' => '1.10.0.0',
            'type' => 'composer-plugin',
            'install_path' => __DIR__ . '/./installers',
            'aliases' => array(),
            'reference' => '1a0357fccad9d1cc1ea0c9a05b8847fbccccb78d',
            'dev_requirement' => false,
        ),
        'cordoval/hamcrest-php' => array(
            'dev_requirement' => true,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'davedevelopment/hamcrest-php' => array(
            'dev_requirement' => true,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'dealerdirect/phpcodesniffer-composer-installer' => array(
            'pretty_version' => 'v0.7.1',
            'version' => '0.7.1.0',
            'type' => 'composer-plugin',
            'install_path' => __DIR__ . '/../dealerdirect/phpcodesniffer-composer-installer',
            'aliases' => array(),
            'reference' => 'fe390591e0241955f22eb9ba327d137e501c771c',
            'dev_requirement' => true,
        ),
        'doctrine/instantiator' => array(
            'pretty_version' => '1.4.0',
            'version' => '1.4.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../doctrine/instantiator',
            'aliases' => array(),
            'reference' => 'd56bf6102915de5702778fe20f2de3b2fe570b5b',
            'dev_requirement' => true,
        ),
        'grogy/php-parallel-lint' => array(
            'dev_requirement' => true,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'hamcrest/hamcrest-php' => array(
            'pretty_version' => 'v2.0.1',
            'version' => '2.0.1.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../hamcrest/hamcrest-php',
            'aliases' => array(),
            'reference' => '8c3d0a3f6af734494ad8f6fbbee0ba92422859f3',
            'dev_requirement' => true,
        ),
        'jakub-onderka/php-console-color' => array(
            'dev_requirement' => true,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'jakub-onderka/php-console-highlighter' => array(
            'dev_requirement' => true,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'jakub-onderka/php-parallel-lint' => array(
            'dev_requirement' => true,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'kodova/hamcrest-php' => array(
            'dev_requirement' => true,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'mockery/mockery' => array(
            'pretty_version' => '1.3.4',
            'version' => '1.3.4.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../mockery/mockery',
            'aliases' => array(),
            'reference' => '31467aeb3ca3188158613322d66df81cedd86626',
            'dev_requirement' => true,
        ),
        'myclabs/deep-copy' => array(
            'pretty_version' => '1.10.2',
            'version' => '1.10.2.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../myclabs/deep-copy',
            'aliases' => array(),
            'reference' => '776f831124e9c62e1a2c601ecc52e776d8bb7220',
            'dev_requirement' => true,
            'replaced' => array(
                0 => '1.10.2',
            ),
        ),
        'php-parallel-lint/php-console-color' => array(
            'pretty_version' => 'v0.3',
            'version' => '0.3.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../php-parallel-lint/php-console-color',
            'aliases' => array(),
            'reference' => 'b6af326b2088f1ad3b264696c9fd590ec395b49e',
            'dev_requirement' => true,
        ),
        'php-parallel-lint/php-console-highlighter' => array(
            'pretty_version' => 'v0.5',
            'version' => '0.5.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../php-parallel-lint/php-console-highlighter',
            'aliases' => array(),
            'reference' => '21bf002f077b177f056d8cb455c5ed573adfdbb8',
            'dev_requirement' => true,
        ),
        'php-parallel-lint/php-parallel-lint' => array(
            'pretty_version' => 'v1.3.0',
            'version' => '1.3.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../php-parallel-lint/php-parallel-lint',
            'aliases' => array(),
            'reference' => '772a954e5f119f6f5871d015b23eabed8cbdadfb',
            'dev_requirement' => true,
        ),
        'phpcompatibility/php-compatibility' => array(
            'pretty_version' => '9.3.5',
            'version' => '9.3.5.0',
            'type' => 'phpcodesniffer-standard',
            'install_path' => __DIR__ . '/../phpcompatibility/php-compatibility',
            'aliases' => array(),
            'reference' => '9fb324479acf6f39452e0655d2429cc0d3914243',
            'dev_requirement' => true,
        ),
        'phpcompatibility/phpcompatibility-paragonie' => array(
            'pretty_version' => '1.3.1',
            'version' => '1.3.1.0',
            'type' => 'phpcodesniffer-standard',
            'install_path' => __DIR__ . '/../phpcompatibility/phpcompatibility-paragonie',
            'aliases' => array(),
            'reference' => 'ddabec839cc003651f2ce695c938686d1086cf43',
            'dev_requirement' => true,
        ),
        'phpcompatibility/phpcompatibility-wp' => array(
            'pretty_version' => '2.1.1',
            'version' => '2.1.1.0',
            'type' => 'phpcodesniffer-standard',
            'install_path' => __DIR__ . '/../phpcompatibility/phpcompatibility-wp',
            'aliases' => array(),
            'reference' => 'b7dc0cd7a8f767ccac5e7637550ea1c50a67b09e',
            'dev_requirement' => true,
        ),
        'phpdocumentor/reflection-common' => array(
            'pretty_version' => '2.2.0',
            'version' => '2.2.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../phpdocumentor/reflection-common',
            'aliases' => array(),
            'reference' => '1d01c49d4ed62f25aa84a747ad35d5a16924662b',
            'dev_requirement' => true,
        ),
        'phpdocumentor/reflection-docblock' => array(
            'pretty_version' => '5.2.2',
            'version' => '5.2.2.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../phpdocumentor/reflection-docblock',
            'aliases' => array(),
            'reference' => '069a785b2141f5bcf49f3e353548dc1cce6df556',
            'dev_requirement' => true,
        ),
        'phpdocumentor/type-resolver' => array(
            'pretty_version' => '1.4.0',
            'version' => '1.4.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../phpdocumentor/type-resolver',
            'aliases' => array(),
            'reference' => '6a467b8989322d92aa1c8bf2bebcc6e5c2ba55c0',
            'dev_requirement' => true,
        ),
        'phpspec/prophecy' => array(
            'pretty_version' => 'v1.10.3',
            'version' => '1.10.3.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../phpspec/prophecy',
            'aliases' => array(),
            'reference' => '451c3cd1418cf640de218914901e51b064abb093',
            'dev_requirement' => true,
        ),
        'phpunit/php-code-coverage' => array(
            'pretty_version' => '4.0.8',
            'version' => '4.0.8.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../phpunit/php-code-coverage',
            'aliases' => array(),
            'reference' => 'ef7b2f56815df854e66ceaee8ebe9393ae36a40d',
            'dev_requirement' => true,
        ),
        'phpunit/php-file-iterator' => array(
            'pretty_version' => '1.4.5',
            'version' => '1.4.5.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../phpunit/php-file-iterator',
            'aliases' => array(),
            'reference' => '730b01bc3e867237eaac355e06a36b85dd93a8b4',
            'dev_requirement' => true,
        ),
        'phpunit/php-text-template' => array(
            'pretty_version' => '1.2.1',
            'version' => '1.2.1.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../phpunit/php-text-template',
            'aliases' => array(),
            'reference' => '31f8b717e51d9a2afca6c9f046f5d69fc27c8686',
            'dev_requirement' => true,
        ),
        'phpunit/php-timer' => array(
            'pretty_version' => '1.0.9',
            'version' => '1.0.9.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../phpunit/php-timer',
            'aliases' => array(),
            'reference' => '3dcf38ca72b158baf0bc245e9184d3fdffa9c46f',
            'dev_requirement' => true,
        ),
        'phpunit/php-token-stream' => array(
            'pretty_version' => '2.0.2',
            'version' => '2.0.2.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../phpunit/php-token-stream',
            'aliases' => array(),
            'reference' => '791198a2c6254db10131eecfe8c06670700904db',
            'dev_requirement' => true,
        ),
        'phpunit/phpcov' => array(
            'pretty_version' => '3.1.0',
            'version' => '3.1.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../phpunit/phpcov',
            'aliases' => array(),
            'reference' => '2005bd90c2c8aae6d93ec82d9cda9d55dca96c3d',
            'dev_requirement' => true,
        ),
        'phpunit/phpunit' => array(
            'pretty_version' => '5.7.27',
            'version' => '5.7.27.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../phpunit/phpunit',
            'aliases' => array(),
            'reference' => 'b7803aeca3ccb99ad0a506fa80b64cd6a56bbc0c',
            'dev_requirement' => true,
        ),
        'phpunit/phpunit-mock-objects' => array(
            'pretty_version' => '3.4.4',
            'version' => '3.4.4.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../phpunit/phpunit-mock-objects',
            'aliases' => array(),
            'reference' => 'a23b761686d50a560cc56233b9ecf49597cc9118',
            'dev_requirement' => true,
        ),
        'psr/log' => array(
            'pretty_version' => '1.1.3',
            'version' => '1.1.3.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../psr/log',
            'aliases' => array(),
            'reference' => '0f73288fd15629204f9d42b7055f72dacbe811fc',
            'dev_requirement' => true,
        ),
        'psr/log-implementation' => array(
            'dev_requirement' => true,
            'provided' => array(
                0 => '1.0',
            ),
        ),
        'roundcube/plugin-installer' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'sebastian/code-unit-reverse-lookup' => array(
            'pretty_version' => '1.0.2',
            'version' => '1.0.2.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../sebastian/code-unit-reverse-lookup',
            'aliases' => array(),
            'reference' => '1de8cd5c010cb153fcd68b8d0f64606f523f7619',
            'dev_requirement' => true,
        ),
        'sebastian/comparator' => array(
            'pretty_version' => '1.2.4',
            'version' => '1.2.4.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../sebastian/comparator',
            'aliases' => array(),
            'reference' => '2b7424b55f5047b47ac6e5ccb20b2aea4011d9be',
            'dev_requirement' => true,
        ),
        'sebastian/diff' => array(
            'pretty_version' => '1.4.3',
            'version' => '1.4.3.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../sebastian/diff',
            'aliases' => array(),
            'reference' => '7f066a26a962dbe58ddea9f72a4e82874a3975a4',
            'dev_requirement' => true,
        ),
        'sebastian/environment' => array(
            'pretty_version' => '2.0.0',
            'version' => '2.0.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../sebastian/environment',
            'aliases' => array(),
            'reference' => '5795ffe5dc5b02460c3e34222fee8cbe245d8fac',
            'dev_requirement' => true,
        ),
        'sebastian/exporter' => array(
            'pretty_version' => '2.0.0',
            'version' => '2.0.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../sebastian/exporter',
            'aliases' => array(),
            'reference' => 'ce474bdd1a34744d7ac5d6aad3a46d48d9bac4c4',
            'dev_requirement' => true,
        ),
        'sebastian/finder-facade' => array(
            'pretty_version' => '1.2.3',
            'version' => '1.2.3.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../sebastian/finder-facade',
            'aliases' => array(),
            'reference' => '167c45d131f7fc3d159f56f191a0a22228765e16',
            'dev_requirement' => true,
        ),
        'sebastian/global-state' => array(
            'pretty_version' => '1.1.1',
            'version' => '1.1.1.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../sebastian/global-state',
            'aliases' => array(),
            'reference' => 'bc37d50fea7d017d3d340f230811c9f1d7280af4',
            'dev_requirement' => true,
        ),
        'sebastian/object-enumerator' => array(
            'pretty_version' => '2.0.1',
            'version' => '2.0.1.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../sebastian/object-enumerator',
            'aliases' => array(),
            'reference' => '1311872ac850040a79c3c058bea3e22d0f09cbb7',
            'dev_requirement' => true,
        ),
        'sebastian/recursion-context' => array(
            'pretty_version' => '2.0.0',
            'version' => '2.0.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../sebastian/recursion-context',
            'aliases' => array(),
            'reference' => '2c3ba150cbec723aa057506e73a8d33bdb286c9a',
            'dev_requirement' => true,
        ),
        'sebastian/resource-operations' => array(
            'pretty_version' => '1.0.0',
            'version' => '1.0.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../sebastian/resource-operations',
            'aliases' => array(),
            'reference' => 'ce990bb21759f94aeafd30209e8cfcdfa8bc3f52',
            'dev_requirement' => true,
        ),
        'sebastian/version' => array(
            'pretty_version' => '2.0.1',
            'version' => '2.0.1.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../sebastian/version',
            'aliases' => array(),
            'reference' => '99732be0ddb3361e16ad77b68ba41efc8e979019',
            'dev_requirement' => true,
        ),
        'shama/baton' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'squizlabs/php_codesniffer' => array(
            'pretty_version' => '3.6.0',
            'version' => '3.6.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../squizlabs/php_codesniffer',
            'aliases' => array(),
            'reference' => 'ffced0d2c8fa8e6cdc4d695a743271fab6c38625',
            'dev_requirement' => true,
        ),
        'symfony/console' => array(
            'pretty_version' => 'v3.4.47',
            'version' => '3.4.47.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../symfony/console',
            'aliases' => array(),
            'reference' => 'a10b1da6fc93080c180bba7219b5ff5b7518fe81',
            'dev_requirement' => true,
        ),
        'symfony/debug' => array(
            'pretty_version' => 'v4.4.18',
            'version' => '4.4.18.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../symfony/debug',
            'aliases' => array(),
            'reference' => '5dfc7825f3bfe9bb74b23d8b8ce0e0894e32b544',
            'dev_requirement' => true,
        ),
        'symfony/finder' => array(
            'pretty_version' => 'v5.2.1',
            'version' => '5.2.1.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../symfony/finder',
            'aliases' => array(),
            'reference' => '0b9231a5922fd7287ba5b411893c0ecd2733e5ba',
            'dev_requirement' => true,
        ),
        'symfony/polyfill-ctype' => array(
            'pretty_version' => 'v1.22.0',
            'version' => '1.22.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../symfony/polyfill-ctype',
            'aliases' => array(),
            'reference' => 'c6c942b1ac76c82448322025e084cadc56048b4e',
            'dev_requirement' => true,
        ),
        'symfony/polyfill-mbstring' => array(
            'pretty_version' => 'v1.22.1',
            'version' => '1.22.1.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../symfony/polyfill-mbstring',
            'aliases' => array(),
            'reference' => '5232de97ee3b75b0360528dae24e73db49566ab1',
            'dev_requirement' => true,
        ),
        'symfony/polyfill-php80' => array(
            'pretty_version' => 'v1.22.0',
            'version' => '1.22.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../symfony/polyfill-php80',
            'aliases' => array(),
            'reference' => 'dc3063ba22c2a1fd2f45ed856374d79114998f91',
            'dev_requirement' => true,
        ),
        'symfony/yaml' => array(
            'pretty_version' => 'v4.4.18',
            'version' => '4.4.18.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../symfony/yaml',
            'aliases' => array(),
            'reference' => 'bbce94f14d73732340740366fcbe63363663a403',
            'dev_requirement' => true,
        ),
        'theseer/fdomdocument' => array(
            'pretty_version' => '1.6.6',
            'version' => '1.6.6.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../theseer/fdomdocument',
            'aliases' => array(),
            'reference' => '6e8203e40a32a9c770bcb62fe37e68b948da6dca',
            'dev_requirement' => true,
        ),
        'webmozart/assert' => array(
            'pretty_version' => '1.9.1',
            'version' => '1.9.1.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../webmozart/assert',
            'aliases' => array(),
            'reference' => 'bafc69caeb4d49c39fd0779086c03a3738cbb389',
            'dev_requirement' => true,
        ),
        'wp-coding-standards/wpcs' => array(
            'pretty_version' => '2.3.0',
            'version' => '2.3.0.0',
            'type' => 'phpcodesniffer-standard',
            'install_path' => __DIR__ . '/../wp-coding-standards/wpcs',
            'aliases' => array(),
            'reference' => '7da1894633f168fe244afc6de00d141f27517b62',
            'dev_requirement' => true,
        ),
        'yoast/i18n-module' => array(
            'pretty_version' => '3.1.1',
            'version' => '3.1.1.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../yoast/i18n-module',
            'aliases' => array(),
            'reference' => '9d0a2f6daea6fb42376b023e7778294d19edd85d',
            'dev_requirement' => false,
        ),
        'yoast/phpunit-polyfills' => array(
            'pretty_version' => '0.2.0',
            'version' => '0.2.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../yoast/phpunit-polyfills',
            'aliases' => array(),
            'reference' => 'c48e4cf0c44b2d892540846aff19fb0468627bab',
            'dev_requirement' => true,
        ),
        'yoast/wordpress-seo' => array(
            'pretty_version' => '16.6',
            'version' => '16.6.0.0',
            'type' => 'wordpress-plugin',
            'install_path' => __DIR__ . '/../yoast/wordpress-seo',
            'aliases' => array(),
            'reference' => 'db6bc6c3bc017b39d45365da85970707df200a82',
            'dev_requirement' => false,
        ),
        'yoast/wordpress-seo-premium' => array(
            'pretty_version' => 'dev-master',
            'version' => 'dev-master',
            'type' => 'wordpress-plugin',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'reference' => '8241c83aa3922ccba9b5935b65fd35db9ace1ddf',
            'dev_requirement' => false,
        ),
        'yoast/wp-test-utils' => array(
            'pretty_version' => '0.2.1',
            'version' => '0.2.1.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../yoast/wp-test-utils',
            'aliases' => array(),
            'reference' => 'c5cdabd58f2aa6f2a93f734cf48125f880c90101',
            'dev_requirement' => true,
        ),
        'yoast/yoastcs' => array(
            'pretty_version' => '2.1.0',
            'version' => '2.1.0.0',
            'type' => 'phpcodesniffer-standard',
            'install_path' => __DIR__ . '/../yoast/yoastcs',
            'aliases' => array(),
            'reference' => '8cc5cb79b950588f05a45d68c3849ccfcfef6298',
            'dev_requirement' => true,
        ),
    ),
);
