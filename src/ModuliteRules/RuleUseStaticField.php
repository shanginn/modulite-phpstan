<?php

declare(strict_types=1);

namespace ModulitePHPStan\ModuliteRules;

use ModulitePHPStan\DebugHelpers;
use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\ShouldNotHappenException;

class RuleUseStaticField extends ModuliteRuleBase {
  public function getNodeType(): string {
    return Node\Expr\StaticPropertyFetch::class;
  }

  protected function doProcessNode(Node $node, Scope $scope, array &$errors): void {
    if (!$node instanceof Node\Expr\StaticPropertyFetch) {
      throw new ShouldNotHappenException("got \$node of class " . get_class($node));
    }
    if (!$node->class instanceof Node\Name) {   // $class_name::$field
      return;
    }

    $class_resolved = $scope->resolveName($node->class);    // deal with 'self', etc.
    if (!$this->reflector->hasClass($class_resolved)) {
      return;
    }

    $klass = $this->reflector->getClass($class_resolved, $scope);
    $property_name = $node->name->toString();
//    $this->debug($klass, $property_name, $scope);
    $this->checker->modulite_check_when_use_static_field($scope, $property_name, $klass, $errors);
  }

  private function debug(\PHPStan\Reflection\ClassReflection $klass, string $property_name, Scope $scope) {
    $c_name = $klass->getName();
    $cur_place = DebugHelpers::stringifyScope($scope);
    $ref_loc = DebugHelpers::stringifyLocation($klass->getFileName());

    echo "use $c_name::\$$property_name ($ref_loc) from $cur_place", "\n";
  }
}
