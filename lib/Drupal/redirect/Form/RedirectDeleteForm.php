<?php

namespace Drupal\redirect\Form;

use Drupal\Core\Entity\ContentEntityConfirmFormBase;
use Drupal\Core\Entity\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RedirectDeleteForm extends ContentEntityConfirmFormBase {

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete the URL redirect from %source to %redirect?', array('%source' => $this->entity->getSourceUrl(), '%redirect' => $this->entity->getRedirectUrl()));
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelRoute() {
    return array(
      'route_name' => 'redirect.list',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Delete');
  }

  /**
   * {@inheritdoc}
   */
  public function submit(array $form, array &$form_state) {
    $this->entity->delete();
    drupal_set_message(t('The redirect %redirect has been deleted.', array('%redirect' => $this->entity->getRedirectUrl())));
    $form_state['redirect_route']['route_name'] = 'redirect.list';
  }

}
