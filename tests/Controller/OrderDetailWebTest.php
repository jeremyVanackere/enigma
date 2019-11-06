<?php


namespace App\Tests\Controller;


use App\Entity\Order;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;

class OrderDetailWebTest extends WebTestCase
{
    public function testInvalideSwitchStatus() {
        $client = static::createClient();
        $client->request('GET', '/orders/103/status/nimportequoi');
        $this->assertInstanceOf(RedirectResponse::class, $client->getResponse());

        $crawler = $client->followRedirect();

        $this->assertContains('Cette valeur doit être l\'un des choix proposés.',
            $crawler->filter('div.alert')->text());
    }

    public function testValidSwitchStatus() {
        $client = static::createClient();
        foreach (Order::STATUSES as $status) {
            $this->requestSwitchStatus($client, $status);
        }
    }

    public function requestSwitchStatus(KernelBrowser $client, string $status) {
        $client->request('GET',"/orders/103/status/$status");
        $this->assertInstanceOf(RedirectResponse::class, $client->getResponse());

        $crawler = $client->followRedirect();

        $this->assertContains('Status mis à jour avec succès.',
            $crawler->filter('div.alert')->text(),
            "failed sur $status"
        );
    }
}