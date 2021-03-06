<?php
##*HEADER*##

/**
 * HTML View class for the ECR_COM_NAME Component.
 *
 * @package    ECR_COM_NAME
 * @subpackage Views
 */
class ECR_COM_NAMEViewECR_COM_NAME extends JViewLegacy
{
    /**
     * @var
     */
    protected $item;

    /**
     * @var JForm
     */
    protected $form;

    /**
     * @var string
     */
    protected $script;
    /**
     * ECR_COM_NAMEECR_LIST_POSTFIX view display method.
     *
     * @param string $tpl The name of the template file to parse;
     *
     * @return void
     */
    public function display($tpl = null)
    {
        $this->item = $this->get('Item');
        $this->form = $this->get('Form');
        $this->script = $this->get('Script');

        $errors = $this->get('Errors');

        if(count($errors))
        {
            JFactory::getApplication()->enqueueMessage(implode('<br />', $errors), 'error');

            return;
        }

        $this->addToolBar();

        parent::display($tpl);

        $this->setDocument();
    }

    /**
     * Setting the toolbar
     */
    protected function addToolBar()
    {
        JFactory::getApplication()->input->set('hidemainmenu', true);

        $isNew = ($this->item->id == 0);

        JToolBarHelper::title($isNew
                ? JText::_('ECR_UPPER_COM_COM_NAME_MANAGER_ECR_UPPER_COM_NAME_NEW')
                : JText::_('ECR_UPPER_COM_COM_NAME_MANAGER_ECR_UPPER_COM_NAME_EDIT')
            , 'ECR_LOWER_COM_NAME');

        JToolBarHelper::save('ECR_LOWER_COM_NAME.save');

        JToolBarHelper::cancel('ECR_LOWER_COM_NAME.cancel'
            , $isNew
                ? 'JTOOLBAR_CANCEL'
                : 'JTOOLBAR_CLOSE');

        JFactory::getDocument()->addStyleDeclaration(
            '.icon-48-ECR_LOWER_COM_NAME {background-image: url('
                .'components/ECR_COM_COM_NAME/assets/images/ECR_COM_COM_NAME-48.png);}'
        );
    }

    /**
     * Method to set up the document properties
     *
     * @return void
     */
    protected function setDocument()
    {
        $isNew = ($this->item->id < 1);

        $document = JFactory::getDocument();

        $document->setTitle($isNew
            ? JText::_('ECR_UPPER_COM_COM_NAME_ECR_UPPER_COM_NAME_CREATING')
            : JText::_('ECR_UPPER_COM_COM_NAME_ECR_UPPER_COM_NAME_EDITING'));

        $document->addScript(JURI::root(true).$this->script);

        $document->addScript(JURI::root(true)
            .'/administrator/components/ECR_COM_COM_NAME/views/ECR_LOWER_COM_NAME/submitbutton.js');

        JText::script('ECR_UPPER_COM_COM_NAME_ECR_UPPER_COM_NAME_ERROR_UNACCEPTABLE');
    }
}
