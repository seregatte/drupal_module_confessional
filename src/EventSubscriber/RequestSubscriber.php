<?php

namespace Drupal\confessional\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\alexa\AlexaEvent;
use Drupal\node\Entity\Node;

/**
 * Class RequestSubscriber.
 */
class RequestSubscriber implements EventSubscriberInterface {

  /**
   * Gets the event.
   */
  public static function getSubscribedEvents() {
    $events['alexaevent.request'][] = array('onRequest', 0);
    return $events;
  }

  /**
   * Called upon a request event.
   *
   * @param \Drupal\alexa\AlexaEvent $event
   *   The event object.
   */
  public function onRequest(AlexaEvent $event) {
    $request = $event->getRequest();
    $response = $event->getResponse();

    switch ($request->intentName) {
      case 'HeardAConfession':
        $confession = $this->getARandomConfession();
        $response->endSession()->respond($confession);
        // $response->endSession()->respondSSML($confession);
        break;

      case 'MakeAConfession':
        $confession = $request->getSlot('Confession');
        $this->registerAConfession($confession);
        $response->endSession()->respond("I got it, you are so bad!");
        break;

      default:
        $response->respond('I can heard and tell confessions, in order to make a confession you can say... I wanna say that... and what you would like to confession. Or you can say "I wanna heard a confession"');
        break;
    }
  }

  public function registerAConfession($confession){
    
    $node = Node::create([
      'type'        => 'article',
      'title'       => $confession
    ]);
    $node->save();

  }

  public function getARandomConfession(){
    
    $message = '';

    $query = \Drupal::entityQuery('node');
    $query->condition('status', 1);
    $query->condition('type', 'article');
    $entity_ids = $query->execute();
    
    if(count($entity_ids) > 0 ){
      
      $nid = array_rand($entity_ids);
      $node = Node::load($nid);
      $message = $node->getTitle();
      // $message = sprintf('<speak><amazon:effect name="whispered">%s</amazon:effect></speak>', $message);

    } else {
      
      $message = 'Sorry, but I don\'t know any secret';
      // $message = sprintf('<speak>%s</speak>', $message);
    
    }

    return $message;
  }
}
