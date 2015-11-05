<?php
// source: E:\wamp\www\grido-examples\app/templates/@layout.latte

class Templatefafdb3a1aad78a274fcfa648b3c810da extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('c80684495f', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block _flash
//
if (!function_exists($_b->blocks['_flash'][] = '_lb331b8a1409__flash')) { function _lb331b8a1409__flash($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->redrawControl('flash', FALSE)
;$iterations = 0; foreach ($flashes as $flash) { ?>                <div class="alert alert-<?php echo Latte\Runtime\Filters::escapeHtml($flash->type, ENT_COMPAT) ?> fade in">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <p><?php echo Latte\Runtime\Filters::escapeHtml($flash->message, ENT_NOQUOTES) ?></p>
                </div>
<?php $iterations++; } 
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start();}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIRuntime::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
$gridoAssetsPath = 'https://cdn.rawgit.com/o5/grido/1a4f1e5' ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Blablabla</title>
        <meta name="description" content="Grido - DataGrid for Nette Framework">
        <meta name="author" content="Petr Bugyík">
<?php if (isset($robots)) { ?>        <meta name="robots" content="<?php echo Latte\Runtime\Filters::escapeHtml($robots, ENT_COMPAT) ?>">
<?php } ?>
        <link rel="shortcut icon" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($baseUri), ENT_COMPAT) ?>/favicon.ico">
        <link rel="stylesheet" href="https://cdn.rawgit.com/simonwhitaker/github-fork-ribbon-css/0.1.1/gh-fork-ribbon.css">
        <!--[if IE]>
            <link rel="stylesheet" href="https://cdn.rawgit.com/simonwhitaker/github-fork-ribbon-css/0.1.1/gh-fork-ribbon.ie.css">
        <![endif]-->
        <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v3.1.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v3.1.1/dist/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="https://cdn.rawgit.com/dangrossman/bootstrap-daterangepicker/v1.3.17/daterangepicker-bs3.css">
        <link rel="stylesheet" href="https://cdn.rawgit.com/hyspace/typeahead.js-bootstrap3.less/v0.2.3/typeahead.css">
        <link rel="stylesheet" href="https://cdn.rawgit.com/rstacruz/nprogress/v0.1.6/nprogress.css">
        <link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($gridoAssetsPath), ENT_COMPAT) ?>/client-side/css/grido.css">
        <link href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($gridoAssetsPath), ENT_COMPAT) ?>/client-side/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($baseUri), ENT_COMPAT) ?>/css/style.css">
    </head>
    <body>
        <div id="content" style="max-width:80em;margin:0 auto;">
                <div class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($baseUri), ENT_COMPAT) ?>/">Domácí úkol</a>
<?php if ($user -> isLoggedIn() && $user->isAllowed('users','add')) { ?>                        <a class="btn btn-default btn-sm createnew" style="position:relative;top:7px;left:50px;" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Users:add"), ENT_COMPAT) ?>
">Vytvořit nového uživatele</a>
<?php } ?>
                    </div>

                </div>
            </div>

<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); } ?>
<div id="<?php echo $_control->getSnippetId('flash') ?>"><?php call_user_func(reset($_b->blocks['_flash']), $_b, $template->getParameters()) ?>
</div>
<?php Latte\Macros\BlockMacrosRuntime::callBlock($_b, 'content', $template->getParameters()) ?>

        </div>

        <script src="https://cdn.rawgit.com/moment/moment/2.9.0/moment.js"></script>
        <script src="https://cdn.rawgit.com/jquery/jquery/1.11.2/dist/jquery.min.js"></script>
        <script src="https://cdn.rawgit.com/twbs/bootstrap/v3.1.1/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.rawgit.com/dangrossman/bootstrap-daterangepicker/v1.3.17/daterangepicker.js"></script>
        <script src="https://cdn.rawgit.com/nette/forms/v2.2.4/src/assets/netteForms.js"></script>

<?php $ajax = $presenter->getParameter('ajax') == 'on' ;if ($ajax) { ?>        <script src="https://cdn.rawgit.com/browserstate/history.js/1.8.0/scripts/bundled/html4+html5/jquery.history.js"></script>
<?php } if ($ajax) { ?>        <script src="https://cdn.rawgit.com/twitter/typeahead.js/v0.10.5/dist/typeahead.bundle.min.js"></script>
<?php } if ($ajax) { ?>        <script src="https://cdn.rawgit.com/vojtech-dobes/nette.ajax.js/2.0.0/nette.ajax.js"></script>
<?php } if ($ajax) { ?>        <script src="https://cdn.rawgit.com/rstacruz/nprogress/v0.1.6/nprogress.js"></script>
<?php } if ($ajax) { ?>        <script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($baseUri), ENT_COMPAT) ?>/js/nette.nprogress.js"></script>
<?php } ?>

        <script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($gridoAssetsPath), ENT_COMPAT) ?>/client-side/js/grido.js"></script>
        <script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($gridoAssetsPath), ENT_COMPAT) ?>/client-side/js/plugins/grido.datepicker.js"></script>
<?php if ($ajax) { ?>        <script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($gridoAssetsPath), ENT_COMPAT) ?>/client-side/js/plugins/grido.typeahead.js"></script>
<?php } if ($ajax) { ?>        <script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($gridoAssetsPath), ENT_COMPAT) ?>/client-side/js/plugins/grido.history.js"></script>
<?php } if ($ajax) { ?>        <script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($gridoAssetsPath), ENT_COMPAT) ?>/client-side/js/plugins/grido.nette.ajax.js"></script>
<?php } ?>

<?php if ($ajax) { ?>        <script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($baseUri), ENT_COMPAT) ?>/js/main.ajax.js"></script>
<?php } if (!$ajax) { ?>        <script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($baseUri), ENT_COMPAT) ?>/js/main.js"></script>
<?php } ?>
    </body>
</html>
<?php
}}