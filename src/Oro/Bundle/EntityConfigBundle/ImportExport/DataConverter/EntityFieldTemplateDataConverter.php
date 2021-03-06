<?php

namespace Oro\Bundle\EntityConfigBundle\ImportExport\DataConverter;

use Oro\Bundle\EntityExtendBundle\Provider\FieldTypeProvider;

class EntityFieldTemplateDataConverter extends EntityFieldDataConverter
{
    /** @var FieldTypeProvider */
    protected $fieldTypeProvider;

    /** @var array */
    protected $excludedFields = ['enum.enum_options', 'attachment.attachment'];

    /**
     * @param FieldTypeProvider $fieldTypeProvider
     */
    public function __construct(FieldTypeProvider $fieldTypeProvider)
    {
        $this->fieldTypeProvider = $fieldTypeProvider;
    }

    /**
     * {@inheritdoc}
     */
    protected function getBackendHeader()
    {
        $header = ['fieldName', 'is_serialized', 'type'];

        foreach ($this->fieldTypeProvider->getSupportedFieldTypes() as $fieldType) {
            $properties = $this->fieldTypeProvider->getFieldProperties($fieldType);

            foreach ($properties as $scope => $fields) {
                foreach ($fields as $code => $config) {
                    $field = sprintf('%s.%s', $scope, $code);

                    if (in_array($field, $this->excludedFields, true) || in_array($field, $header, true)) {
                        continue;
                    }
                    $header[] = $field;
                }
            }
        }

        return array_merge(
            $header,
            [
                'enum.enum_options.0.label',
                'enum.enum_options.0.is_default',
                'enum.enum_options.1.label',
                'enum.enum_options.1.is_default',
                'enum.enum_options.2.label',
                'enum.enum_options.2.is_default'
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function fillEmptyColumns(array $header, array $data)
    {
        $dataDiff = array_diff(array_keys($data), $header);
        $data = array_diff_key($data, array_flip($dataDiff));

        return parent::fillEmptyColumns($header, $data);
    }
}
