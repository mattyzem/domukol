<?php
// source: E:\wamp\www\grido-examples\app/templates/Login/login.latte

class Template51e2c55040ca9b9d6e23a8ca1de40e0c extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('291b553d41', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbf451469cb6_content')) { function _lbf451469cb6_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <?php echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form = $_form = $_control["loginForm"], array()) ?>

    <div class="container" style="width:27em;">
<?php if ($form->hasErrors()) { ?>      <div class="alert alert-danger" role="alert">
<?php $iterations = 0; foreach ($form->errors as $error) { ?>        <p><?php echo Latte\Runtime\Filters::escapeHtml($error, ENT_NOQUOTES) ?></p>
<?php $iterations++; } ?>
      </div>
<?php } ?>

      <h2 class="form-signin-heading">Přihlášení</h2>
      <label for="inputEmail" class="sr-only">Jméno</label>
      <?php echo $_form["name"]->getControl() ?>

      <br>
      <label for="inputPassword" class="sr-only">Heslo</label>
      <?php echo $_form["password"]->getControl() ?>

      <br>
      <?php echo $_form["signin"]->getControl() ?>

    </div>
    <?php echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd($_form) ?>

<?php
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
?>

<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 
}}