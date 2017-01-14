This is a system message.

User {$user->username} {$user->email} requested new category "{$input->name}" in {$parent->name} [{$input->parent}].

To add this category run query:

INSERT INTO category ( name, parent ) VALUES ( '{$input->name}', {$input->parent} );

User's note;

{$input->note}