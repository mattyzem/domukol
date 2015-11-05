<?php
// source: E:\wamp\www\grido-examples\vendor\o5\grido\src/Grid.latte

class Templatee924695d7cbd33edd8171b345e1644ba extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('4c472325ff', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block _grid
//
if (!function_exists($_b->blocks['_grid'][] = '_lb862cae0c6f__grid')) { function _lb862cae0c6f__grid($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->redrawControl('grid', FALSE)
;$form->getElementPrototype()->class[] = 'ajax grido';

    $operation = $control->hasOperation();
    $actions = $control->hasActions() ? $control->getComponent(\Grido\Components\Actions\Action::ID)->getComponents() : array();

    $filters = $control->hasFilters() ? $form->getComponent(\Grido\Components\Filters\Filter::ID)->getComponents() : array();
    $filterRenderType = $control->getFilterRenderType();

    $columns = $control->getComponent(\Grido\Components\Columns\Column::ID)->getComponents();
    $columnCount = count($columns) + ($operation ? 1 : 0);
    $showActionsColumn = $actions || ($filters && $filterRenderType == \Grido\Components\Filters\Filter::RENDER_INNER);

    
    $buttons = $form->getComponent('buttons');
    $buttons->getComponent('search')->getControlPrototype()->class[] = 'btn btn-default btn-sm search';
    $buttons->getComponent('reset')->getControlPrototype()->class[] = 'btn btn-default btn-sm reset';

    $form['count']->controlPrototype->class[] = 'form-control';
    $operation ? $form['operations']['operations']->controlPrototype->class[] = 'form-control' : NULL ?>

<?php $iterations = 0; foreach ($filters as $filter) { $filter->controlPrototype->class[] = 'form-control' ;$iterations++; } ?>

<?php $iterations = 0; foreach ($actions as $action) { $element = $action->getElementPrototype();
            $element->class[] = 'btn btn-default btn-xs btn-mini'; if ($icon = $action->getOption('icon')) { $element->setText(' ' . $action->getLabel());
            $element->insert(0, \Nette\Utils\Html::el('i')->setClass(array("glyphicon glyphicon-$icon fa fa-$icon icon-$icon"))); } $iterations++; } if ($form->getErrors()) { $iterations = 0; foreach ($form->getErrors() as $error) { ?><ul>
    <li><?php echo Latte\Runtime\Filters::escapeHtml($error, ENT_NOQUOTES) ?></li>
</ul>
<?php $iterations++; } } echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form = $_form = $_control["form"], array()) ?>

<?php if ($filterRenderType == \Grido\Components\Filters\Filter::RENDER_OUTER) { call_user_func(reset($_b->blocks['outerFilter']), $_b, get_defined_vars()) ; } ?>

<?php call_user_func(reset($_b->blocks['table']), $_b, get_defined_vars()) ; echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd($_form) ?>

<?php
}}

//
// block outerFilter
//
if (!function_exists($_b->blocks['outerFilter'][] = '_lbb9d282d14f_outerFilter')) { function _lbb9d282d14f_outerFilter($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <div class="filter outer">
        <div class="items">
<?php $iterations = 0; foreach ($filters as $filter) { ?>            <span class="grid-filter-<?php echo Latte\Runtime\Filters::escapeHtml($filter->getName(), ENT_COMPAT) ?>">
                <?php echo Latte\Runtime\Filters::escapeHtml($filter->getLabel(), ENT_NOQUOTES) ?>

                <?php echo Latte\Runtime\Filters::escapeHtml($filter->getControl(), ENT_NOQUOTES) ?>

            </span>
<?php $iterations++; } ?>
        </div>
        <div class="buttons">
<?php $_formStack[] = $_form; $formContainer = $_form = $_form["buttons"] ;if ($filters) { ?>
                    <?php echo $_form["search"]->getControl() ?>

<?php } ?>
                <?php echo $_form["reset"]->getControl() ?>

<?php $formContainer = $_form = array_pop($_formStack) ?>
        </div>
    </div>
<?php
}}

//
// block table
//
if (!function_exists($_b->blocks['table'][] = '_lbba7a3ce5ef_table')) { function _lbba7a3ce5ef_table($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;echo $control->getTablePrototype()->startTag() ?>

    <thead>
        <tr class="head">
<?php if ($operation) { ?>            <th class="checker"<?php if ($filters) { ?>
 rowspan="<?php if ($filterRenderType == \Grido\Components\Filters\Filter::RENDER_OUTER) { ?>
1<?php } else { ?>2<?php } ?>"<?php } ?>>
                <input type="checkbox" title="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Grido.Invert'), ENT_COMPAT) ?>">
            </th>
<?php } $iterations = 0; foreach ($columns as $column) { ?>
                <?php echo $column->getHeaderPrototype()->startTag() ?>

<?php if ($column->isSortable()) { if (!$column->getSort()) { ?>                        <a class="ajax" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("sort!", array(array($column->getName() => \Grido\Components\Columns\Column::ORDER_ASC))), ENT_COMPAT) ?>
"><?php echo $column->getLabel() ?></a>
<?php } if ($column->getSort() == \Grido\Components\Columns\Column::ORDER_ASC) { ?>
                        <a class="sort ajax" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("sort!", array(array($column->getName() => \Grido\Components\Columns\Column::ORDER_DESC))), ENT_COMPAT) ?>
"><?php echo $column->getLabel() ?></a>
<?php } if ($column->getSort() == \Grido\Components\Columns\Column::ORDER_DESC) { ?>
                        <a class="sort ajax" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("sort!", array(array($column->getName() => \Grido\Components\Columns\Column::ORDER_ASC))), ENT_COMPAT) ?>
"><?php echo $column->getLabel() ?></a>
<?php } ?>
                        <span></span>
<?php } else { ?>
                        <?php echo $column->getLabel() ?>

<?php } ?>
                <?php echo $column->getHeaderPrototype()->endTag() ?>

<?php $iterations++; } if ($showActionsColumn) { ?>            <th class="actions center">
                <?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Grido.Actions'), ENT_NOQUOTES) ?>

            </th>
<?php } ?>
        </tr>
<?php if ($filterRenderType == \Grido\Components\Filters\Filter::RENDER_INNER && $filters) { ?>        <tr class="filter inner">
<?php $iterations = 0; foreach ($columns as $column) { if ($column->hasFilter()) { ?>
                    <?php echo $control->getFilter($column->getName())->getWrapperPrototype()->startTag() ?>

<?php $_formStack[] = $_form; $formContainer = $_form = $_form["filters"] ?>
                        <?php $_input = is_object($column->getName()) ? $column->getName() : $_form[$column->getName()]; echo $_input->getControl() ?>

<?php $formContainer = $_form = array_pop($_formStack) ?>
                    <?php echo $control->getFilter($column->getName())->getWrapperPrototype()->endTag() ?>

<?php } elseif ($column->headerPrototype->rowspan != 2) { ?>
                    <th>&nbsp;</th>
<?php } $iterations++; } ?>

<?php call_user_func(reset($_b->blocks['action']), $_b, get_defined_vars())  ?>
        </tr>
<?php } ?>
    </thead>
    <tfoot>
        <tr>
            <td colspan="<?php echo Latte\Runtime\Filters::escapeHtml($showActionsColumn ? $columnCount + 1 : $columnCount, ENT_COMPAT) ?>">
<?php call_user_func(reset($_b->blocks['operations']), $_b, get_defined_vars()) ; call_user_func(reset($_b->blocks['paginator']), $_b, get_defined_vars()) ; call_user_func(reset($_b->blocks['count']), $_b, get_defined_vars())  ?>
            </td>
        </tr>
    </tfoot>
    <tbody>
<?php $propertyAccessor = $control->getPropertyAccessor() ;$iterations = 0; foreach ($data as $row) { $checkbox = $operation
                    ? $form[\Grido\Components\Operation::ID][\Grido\Helpers::formatColumnName($propertyAccessor->getProperty($row, $control->getComponent(\Grido\Components\Operation::ID)->getPrimaryKey()))]
                    : NULL;
                $tr = $control->getRowPrototype($row);
                $tr->class[] = $checkbox && $checkbox->getValue()
                    ? 'selected'
                    : NULL ?>
            <?php echo $tr->startTag() ?>

<?php if ($checkbox) { ?>                <td class="checker">
                    <?php echo Latte\Runtime\Filters::escapeHtml($checkbox->getControl(), ENT_NOQUOTES) ?>

                </td>
<?php } $iterations = 0; foreach ($columns as $column) { $td = $column->getCellPrototype($row) ?>
                    <?php echo $td->startTag() ?>

<?php if (is_string($column->getCustomRender()) && $column->getCustomRenderVariables()) { $_b->templates['4c472325ff']->renderChildTemplate($column->getCustomRender(), array_merge(array('control' => $control, 'presenter' => $control->getPresenter(), 'item' => $row, 'column' => $column, ), $column->getCustomRenderVariables(), array()) + $template->getParameters()) ;} elseif (is_string($column->getCustomRender())) { $_b->templates['4c472325ff']->renderChildTemplate($column->getCustomRender(), array('control' => $control, 'presenter' => $control->getPresenter(), 'item' => $row, 'column' => $column) + $template->getParameters()) ;} else { ?>
                            <?php echo $column->render($row) ?>

<?php } ?>
                    <?php echo $td->endTag() ?>

<?php $iterations++; } if ($showActionsColumn) { ?>                <td class="actions center">
<?php $iterations = 0; foreach ($actions as $action) { if (is_object($action)) $_l->tmp = $action; else $_l->tmp = $_control->getComponent($action); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render($row) ;$iterations++; } if (!$actions) { ?>
                        &nbsp;
<?php } ?>
                </td>
<?php } ?>
            <?php echo $tr->endTag() ?>

<?php $iterations++; } if (!$control->getCount()) { ?>        <tr><td colspan="<?php echo Latte\Runtime\Filters::escapeHtml($showActionsColumn ? $columnCount + 1 : $columnCount, ENT_COMPAT) ?>
" class="no-results"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Grido.NoResults'), ENT_NOQUOTES) ?></td></tr>
<?php } ?>
    </tbody>
<?php echo $control->getTablePrototype()->endTag() ?>

<?php
}}

//
// block action
//
if (!function_exists($_b->blocks['action'][] = '_lba314fdf43f_action')) { function _lba314fdf43f_action($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;if ($filters) { ?>            <th class="buttons">
<?php $_formStack[] = $_form; $formContainer = $_form = $_form["buttons"] ?>
                    <?php echo $_form["search"]->getControl() ?>

                    <?php echo $_form["reset"]->getControl() ?>

<?php $formContainer = $_form = array_pop($_formStack) ?>
            </th>
<?php } 
}}

//
// block operations
//
if (!function_exists($_b->blocks['operations'][] = '_lb1d8edd3bbe_operations')) { function _lb1d8edd3bbe_operations($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;if ($operation) { ?>                <span class="operations"  title="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Grido.SelectSomeRow'), ENT_COMPAT) ?>">
                    <?php echo Latte\Runtime\Filters::escapeHtml($form[\Grido\Components\Operation::ID][\Grido\Components\Operation::ID]->control, ENT_NOQUOTES) ?>

<?php $form[\Grido\Grid::BUTTONS][\Grido\Components\Operation::ID]->controlPrototype->class[] = 'hide' ?>
                    <?php echo Latte\Runtime\Filters::escapeHtml($form[\Grido\Grid::BUTTONS][\Grido\Components\Operation::ID]->control, ENT_NOQUOTES) ?>

                </span>
<?php } 
}}

//
// block paginator
//
if (!function_exists($_b->blocks['paginator'][] = '_lb0b04406b82_paginator')) { function _lb0b04406b82_paginator($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;if ($paginator->steps && $paginator->pageCount > 1) { ?>                <span class="paginator">
<?php if ($control->page == 1) { ?>
                        <span class="btn btn-default btn-xs btn-mini disabled" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("page!", array('page' => $paginator->getPage() - 1)), ENT_COMPAT) ?>
"><i class="glyphicon glyphicon-arrow-left fa fa-arrow-left icon-arrow-left"></i> <?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Grido.Previous'), ENT_NOQUOTES) ?></span>
<?php } else { ?>
                        <a class="btn btn-default btn-xs btn-mini ajax" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("page!", array('page' => $paginator->getPage() - 1)), ENT_COMPAT) ?>
"><i class="glyphicon glyphicon-arrow-left fa fa-arrow-left icon-arrow-left"></i> <?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Grido.Previous'), ENT_NOQUOTES) ?></a>
<?php } $steps = $paginator->getSteps() ;$iterations = 0; foreach ($iterator = $_l->its[] = new Latte\Runtime\CachingIterator($steps) as $step) { if ($step == $control->page) { ?>
                            <span class="btn btn-default btn-xs btn-mini disabled"><?php echo Latte\Runtime\Filters::escapeHtml($step, ENT_NOQUOTES) ?></span>
<?php } else { ?>
                            <a class="btn btn-default btn-xs btn-mini ajax" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("page!", array('page' => $step)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($step, ENT_NOQUOTES) ?></a>
<?php } if ($iterator->nextValue > $step + 1) { ?>                        <a class="prompt" data-grido-prompt="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Grido.EnterPage'), ENT_COMPAT) ?>
" data-grido-link="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("page!", array('page' => 0)), ENT_COMPAT) ?>">...</a>
<?php } $prevStep = $step ;$iterations++; } array_pop($_l->its); $iterator = end($_l->its) ;if ($control->page == $paginator->getPageCount()) { ?>
                        <span class="btn btn-default btn-xs btn-mini disabled" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("page!", array('page' => $paginator->getPage() + 1)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Grido.Next'), ENT_NOQUOTES) ?> <i class="glyphicon glyphicon-arrow-right fa fa-arrow-right icon-arrow-right"></i></span>
<?php } else { ?>
                        <a class="btn btn-default btn-xs btn-mini ajax" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("page!", array('page' => $paginator->getPage() + 1)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Grido.Next'), ENT_NOQUOTES) ?> <i class="glyphicon glyphicon-arrow-right fa fa-arrow-right icon-arrow-right"></i></a>
<?php } ?>
                </span>
<?php } 
}}

//
// block count
//
if (!function_exists($_b->blocks['count'][] = '_lb03a69a0d5a_count')) { function _lb03a69a0d5a_count($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>                <span class="count">
                    <?php echo Latte\Runtime\Filters::escapeHtml(sprintf($template->translate('Grido.Items'), $paginator->getCountBegin(), $paginator->getCountEnd(), $control->getCount()), ENT_NOQUOTES) ?>

                    <?php echo $_form["count"]->getControl() ?>

<?php $_formStack[] = $_form; $formContainer = $_form = $_form["buttons"] ?>
                        <?php echo $_form["perPage"]->getControl()->addAttributes(array('class' => 'hide')) ?>

<?php $formContainer = $_form = array_pop($_formStack) ;if ($control->hasExport()) { ?>
                    <a class="btn btn-default btn-xs btn-mini" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($control->getComponent(\Grido\Components\Export::ID)->link('export!')), ENT_COMPAT) ?>
" title="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Grido.ExportAllItems'), ENT_COMPAT) ?>"><i class="glyphicon glyphicon-download fa fa-download icon-download"></i></a>
<?php } ?>
                </span>
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
if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); } ?>
<div id="<?php echo $_control->getSnippetId('grid') ?>"><?php call_user_func(reset($_b->blocks['_grid']), $_b, $template->getParameters()) ?>
</div><?php
}}