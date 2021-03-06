# Synopsis

This package is used to provide static asset versioning in a fashionly yet simple manner 
to developers. Other more complex static asset versioning systems exist built-in frameworks
but many developers of other frameworks and codebase do not have the ability to benefit from
the static asset versioning.

# Requirements

    - PHP 5.3.x
    - PECL HTTP 

# Example

Many static files as such as *js*, *css*, *png*, etc. are often included in the headers of web-apps
and web-sites. To add versioning simply do the following:

``` php
    <?php require_once 'Orchestra/Versioning.php'; ?>
    <head>
      <script type="text/javascript" src="/path/to/file.js?<?php orchestra\Versioning::version('1');?>"></script>
      <script type="text/javascript" src="/path/to/file2.js?<?php orchestra\Versioning::version('2');?>"></script>
      <script type="text/javascript" src="/path/to/other.js?<?php orchestra\Versioning::version('1');?>"></script>
    </head>
```

The same has to be done for the included CSS files and images. A good example for us is that we use the latest *svn* or *git* 
version. If you do not wish to include different versions, you may want to set a variable, assign a value to it and use it
consistantly across your application like this:

``` php
    <?php require_once 'Orchestra/Versioning.php'; $version = 'x1y2z3'; ?>
    <head>
      <script type="text/javascript" src="/path/to/file.js?<?php orchestra\Versioning::version($version);?>"></script>
      <script type="text/javascript" src="/path/to/file2.js?<?php orchestra\Versioning::version($version);?>"></script>
      <script type="text/javascript" src="/path/to/other.js?<?php orchestra\Versioning::version($version);?>"></script>
    </head>
```

The benefit from using **Orchestra\Versioning** instead of directly using the version number is that you can use various versions
and easily manage them. You can also request a file to have *no-cache* like this:

``` php
    <?php require_once 'Orchestra/Versioning.php'; ?>
    <head>
      <script type="text/javascript" src="/path/to/file.js?<?php orchestra\Versioning::version();?>"></script>
    </head>
```

This will effectively create a new entry in the local cache of the versions with the current `time()` value. If you re-use
this method later in your application, the `time()` function will not be invoked but directly retrieved from the local-cached
map of versions.


# License

This is released under the New BSD license. Should you require a copy of the license, it is
included in this very repository.

# Copyright

Orchestra Platform Ltd. 2011

# Links

[Orchestra.io](https://orchestra.io)
[Orchestra.io Caching Strategies](https://docs.orchestra.io/kb/getting-started/caching-strategies#versioning)
[Yahoo Performance Basics on Versioning](http://developer.yahoo.com/performance/rules.html#js_dupes)

