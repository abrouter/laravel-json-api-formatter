<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\Render\Sections;

use AbRouter\JsonApiFormatter\Document\Collections\RelationshipsCollection;
use AbRouter\JsonApiFormatter\Document\Sections\Identifier;
use AbRouter\JsonApiFormatter\Document\Sections\Relationship;

class RelationshipsRender
{
    public function render(RelationshipsCollection $relationshipsCollection): array
    {
        return array_reduce($relationshipsCollection->getAll(), function (array $acc, Relationship $relationship) {
            if (!$relationship->isCollection()) {
                $acc[$relationship->getKey()] = [
                    'data' => $this->renderIdentifierSection($relationship->getIdentifier()),
                ];

                return $acc;
            }

            $acc[$relationship->getKey()] = [
                'data' => array_reduce(
                    $relationship->getIdentifiersCollection()->getIdentifiers(),
                    function (array $acc, Identifier $identifier) {
                        $acc[] = $this->renderIdentifierSection($identifier);
                        return $acc;
                    },
                    []
                )
            ];

            return $acc;
        }, []);
    }

    private function renderIdentifierSection(Identifier $identifier)
    {
        return [
            'id' => $identifier->getId(),
            'type' => $identifier->getType(),
        ];
    }
}
