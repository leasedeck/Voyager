<?php

use App\Models\User;
use Spatie\Seeders\Faker;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder.
 */
class UserTableSeeder extends Seeder
{
    const WEBMASTER = 'webmaster'; // Role name for webmasters in the application.

    const RVB = 'admin';     // Role name for board members in the application.

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        collect($this->organisationMembers())->each(function (array $name): void {
            [$firstName, $lastName] = $name;

            $data = ['voornaam' => $name[0], 'achternaam' => $name[1], 'email' => strtolower($name[0]).'@leasecrm.be', 'password' => 'password'];
            $user = $this->createBackUser($data);

            if ($this->isInWebmasterArray($user->email)) {
                $user->assignRole(self::WEBMASTER);
            }

            $user->assignRole(self::RVB);
        });
    }

    /**
     * Determine if the given address is an webmaster in the application.
     *
     * @return bool
     */
    protected function isInWebmasterArray(string $email): bool
    {
        return in_array($email, $this->organisationWebmasters());
    }

    /**
     * The array of email addresses that are webmasters in the application.
     *
     * @return array
     */
    protected function organisationWebmasters(): array
    {
        return ['tim@leasecrm.be'];
    }

    /**
     * Get the list of the members in the non profit organisation.
     * This list is also used in the creation of the basic logins
     * for the application barebone.
     *
     * @return array
     */
    protected function organisationMembers(): array
    {
        return [['Tim', 'Joosten']];
    }

    /**
     * Method for creating the actual logins.
     *
     * @param  array $attributes
     * @return User
     */
    protected function createBackUser(array $attributes = []): User
    {
        $person = app(Faker::class)->person();

        return User::create($attributes + [
            'voornaam' => $person['firstName'],
            'achternaam' => $person['lastName'],
            'email' => $person['email'],
            'email_verified_at' => now(),
            'password' => faker()->password,
        ]);
    }
}
