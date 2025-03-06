<!-- <?= $_message = \sprintf('%s (%d %s)', $exceptionMessage, $statusCode, $statusText); ?> -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="<?= $this->charset; ?>" />
        <meta name="robots" content="noindex, nofollow, noarchive, nosnippet, noodp, noimageindex, notranslate, nocache" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <title><?= $_message; ?></title>
        <link rel="icon" type="image/png" href="<?= $this->include('assets/images/favicon.png.base64'); ?>" />
        <style><?= $this->include('assets/css/exception.css'); ?></style>
        <style><?= $this->include('assets/css/exception_full.css'); ?></style>
    </head>
    <body>
        <script>
            document.body.classList.add(
                localStorage.getItem('symfony/profiler/theme') || (matchMedia('(prefers-color-scheme: dark)').matches ? 'theme-dark' : 'theme-light')
            );
        </script>

        <?php if (class_exists(\Symfony\Component\HttpKernel\Kernel::class)) { ?>
            <header>
                <div class="container">
                    <div class="logo">
                        <?= $this->include('assets/images/symfony-logo.svg'); ?>
                        <strong>Symfony Exception</strong>
                        <span class="divider">/</span>
                        <span class="hidden-xs-down">HTTP</span> <span class="status-code"><?= $statusCode; ?></span> <span><?= $statusText; ?></span>
                    </div>

                    <div class="help-link">
                        <a href="https://symfony.com/doc/<?= Symfony\Component\HttpKernel\Kernel::VERSION; ?>/index.html">
                            <span class="icon"><?= $this->include('assets/images/icon-book.svg'); ?></span>
                            <span>Docs</span>
                        </a>
                    </div>
                </div>
            </header>
        <?php } ?>

        <?php if (null !== $requestCollector) { ?>
            <div class="container">
                <div>
                    ...
                </div>
            </div>
        <?php } ?>

        <?= $this->include('views/exception.html.php', $context); ?>

        <script>
            <?= $this->include('assets/js/exception.js'); ?>
        </script>
    </body>
</html>
<!-- <?= $_message; ?> -->
