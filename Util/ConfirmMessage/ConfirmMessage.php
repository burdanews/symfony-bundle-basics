<?php

namespace HBM\BasicsBundle\Util\ConfirmMessage;

use Doctrine\Common\Collections\Collection;
use HBM\BasicsBundle\Entity\AbstractEntity;
use Symfony\Component\Routing\RouterInterface;

class ConfirmMessage {

  public const MODE_DELETE = 'delete';
  public const MODE_NULLIFY = 'nullify';
  public const MODE_REASSIGN = 'reassign';

  /**
   * @var Collection|AbstractEntity[]|array
   */
  private $items = [];

  /**
   * @var string
   */
  private $wording;

  /**
   * @var mixed
   */
  private $mode;

  /**
   * @var mixed
   */
  private $text;

  /**
   * @var mixed
   */
  private $title;

  /**
   * @var mixed
   */
  private $icon;

  /**
   * @var mixed
   */
  private $route;

  /**
   * @var mixed
   */
  private $children;

  /**
   * @var mixed
   */
  private $discard;

  /**
   * @var string
   */
  private $message;


  /****************************************************************************/

  public function __construct($items = [], string $wording = NULL, $mode = NULL) {
    $this->items = $items ?: [];
    $this->wording = $wording;
    $this->mode = $mode;
  }

  /**
   * Set items.
   *
   * @param Collection|AbstractEntity[]|array $items
   *
   * @return self
   */
  public function setItems($items) : self {
    $this->items = $items;

    return $this;
  }

  /**
   * Get items.
   *
   * @return Collection|AbstractEntity[]|array
   */
  public function getItems() {
    return $this->items;
  }

  /**
   * Set wording.
   *
   * @param string $wording
   *
   * @return self
   */
  public function setWording(string $wording = NULL) : self {
    $this->wording = $wording;

    return $this;
  }

  /**
   * Get wording.
   *
   * @return string|null
   */
  public function getWording() : ?string {
    return $this->wording;
  }

  /**
   * Set mode.
   *
   * @param string $mode
   *
   * @return self
   */
  public function setMode(string $mode = NULL) : self {
    $this->mode = $mode;

    return $this;
  }

  /**
   * Get mode.
   *
   * @return string|null
   */
  public function getMode() : ?string {
    return $this->mode;
  }

  /**
   * Set text.
   *
   * @param mixed $text
   *
   * @return self
   */
  public function setText($text = NULL) : self {
    $this->text = $text;

    return $this;
  }

  /**
   * Get text.
   *
   * @return mixed|null
   */
  public function getText() {
    return $this->text;
  }

  /**
   * Set title.
   *
   * @param mixed $title
   *
   * @return self
   */
  public function setTitle($title = NULL) : self {
    $this->title = $title;

    return $this;
  }

  /**
   * Get title.
   *
   * @return mixed|null
   */
  public function getTitle() {
    return $this->title;
  }

  /**
   * Set route.
   *
   * @param mixed $route
   *
   * @return self
   */
  public function setRoute($route = NULL) : self {
    $this->route = $route;

    return $this;
  }

  /**
   * Get route.
   *
   * @return mixed|null
   */
  public function getRoute() {
    return $this->route;
  }

  /**
   * Set icon.
   *
   * @param mixed $icon
   *
   * @return self
   */
  public function setIcon($icon = NULL) : self {
    $this->icon = $icon;

    return $this;
  }

  /**
   * Get icon.
   *
   * @return mixed|null
   */
  public function getIcon() {
    return $this->icon;
  }

  /**
   * Set children.
   *
   * @param mixed $children
   *
   * @return self
   */
  public function setChildren($children) : self {
    $this->children = $children;

    return $this;
  }

  /**
   * Get children.
   *
   * @return mixed
   */
  public function getChildren() {
    return $this->children;
  }

  /**
   * Set discard.
   *
   * @param mixed $discard
   *
   * @return self
   */
  public function setDiscard($discard = NULL) : self {
    $this->discard = $discard;

    return $this;
  }

  /**
   * Get discard.
   *
   * @return mixed|null
   */
  public function getDiscard() {
    return $this->discard;
  }

  /**
   * Set message.
   *
   * @param string $message
   *
   * @return self
   */
  public function setMessage(string $message = NULL) : self {
    $this->message = $message;

    return $this;
  }

  /**
   * Get message.
   *
   * @return string|null
   */
  public function getMessage() : ?string {
    return $this->message;
  }

  /****************************************************************************/

  /**
   * @param AbstractEntity $item
   *
   * @return string
   */
  public function evalId(AbstractEntity $item) : string {
    return ''.$item->getId();
  }

  /**
   * @param AbstractEntity $item
   *
   * @return bool
   */
  public function evalDiscard(AbstractEntity $item) : bool {
    if ($this->discard instanceof \Closure) {
      return (bool) call_user_func($this->discard, $item);
    }

    return FALSE;
  }

  /**
   * @param AbstractEntity $item
   *
   * @return string|null
   */
  public function evalText(AbstractEntity $item) : ?string {
    if ($this->text instanceof \Closure) {
      return call_user_func($this->text, $item);
    } elseif ($this->text !== NULL) {
      if (method_exists($item, $this->text)) {
        return call_user_func([$item, $this->text]);
      } else {
        return $this->text;
      }
    }

    return NULL;
  }

  /**
   * @param AbstractEntity $item
   *
   * @return string|null
   */
  public function evalTitle(AbstractEntity $item) : ?string {
    if ($this->title instanceof \Closure) {
      return call_user_func($this->title, $item);
    } elseif ($this->title !== NULL) {
      if (method_exists($item, $this->title)) {
        return call_user_func([$item, $this->title]);
      } else {
        return $this->title;
      }
    }

    return NULL;
  }

  /**
   * @param AbstractEntity $item
   *
   * @return string|null
   */
  public function evalIcon(AbstractEntity $item) : ?string {
    if ($this->icon instanceof \Closure) {
      return call_user_func($this->icon, $item);
    } elseif ($this->icon !== NULL) {
      return $this->icon;
    }

    return NULL;
  }

  /**
   * @param AbstractEntity $item
   *
   * @return string|null
   */
  public function evalUrl(AbstractEntity $item, RouterInterface $router = NULL) : ?string {
    if ($this->route instanceof \Closure) {
      return call_user_func($this->route, $item, $router);
    } elseif ($this->route !== NULL) {
      $first = $this->route[0] ?? '';
      if ($first === '/') {
        return $this->route;
      } elseif ($router) {
        try {
          return $router->generate($this->route, ['id' => $item->getId()]);
        } catch (\Exception $e) {
        }
      }
    }

    return NULL;
  }

  /**
   * @param AbstractEntity $item
   *
   * @return array
   */
  public function evalChildren(AbstractEntity $item) : array {
    if ($this->children instanceof \Closure) {
      return call_user_func($this->children, $item);
    }

    return [];
  }

  /**
   * @param AbstractEntity $item
   * @param RouterInterface|NULL $router
   *
   * @return string
   */
  public function render(AbstractEntity $item, RouterInterface $router = NULL) : string {
    $id = $this->evalId($item);
    $url = $this->evalUrl($item, $router);
    $text = $this->evalText($item);
    $icon = $this->evalIcon($item);
    $title = $this->evalTitle($item);

    if ($url) {
      return '<a href="'.$url.'" title="'.strip_tags($title ?: $text).'">'.$id.'</a>: '.$text;
    } else {
      return $id.': '.$text;
    }
  }

}
