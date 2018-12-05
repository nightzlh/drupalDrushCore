<?php

namespace Drupal\hello_world\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
*Provides a 'Hello' Block.
*
*@Block(
*	id = "hello_block",
*	admin_label = @Translation("Hello block"),
*	category = @Translation("Hello World"),
*)
*/

class HelloBlock extends BlockBase implements BlockPluginInterface {
	/**
	*{@inheritdoc}
	*/
	public function build(){
		return array(
			'#markup'=>$this->t('Hello, World!'),
		);
	}

	/**
   	* {@inheritdoc}
   	*/	
	
	public function blockForm($form, FormStateInterface $form_state) {
		$form = parent::blockForm($form, $form_state);
		$config = $this->getConfiguration();
	
		$form['hello_block_name'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Who'),
			'#description' => $this->t('Who do you want to say hello to?'),
			'#default_value' => isset($config['hello_block_name']) ? $config['hello_block_name'] : '',
		];

		$form['actions']['custom_submit'] = [
      			'#type' => 'submit',
      			'#name' => 'custom_submit',
      			'#value' => $this->t('Custom Submit'),
			'#submit' => array('::custom_submit_form'),
    		];
		
		return $form;
  	}	

	/**
	* {@inheritdoc}
   	*/
	public function blockSubmit($form, FormStateInterface $form_state) {
		parent::blockSubmit($form, $form_state);
		$values = $form_state->getValues();
		$this->configuration['hello_block_name'] = $values['hello_block_name'];
  	}
	
	/**
	* Custom submit actions
   	*/
	public function custom_submit_form($form, FormStateInterface $form_state) {
		$values = $form_state->getValues();
    		//Perform the required actions
  	}
}

?>
