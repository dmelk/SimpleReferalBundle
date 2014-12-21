SimpleReferalBundle
===================
Simple referal system bundle. Based on Symfony 2.6 and FOS User Bundle

Requirements
------------
1. Symfony 2.6: "symfony/symfony": "2.6.*",
2. FOS User Bundle: "friendsofsymfony/user-bundle": "~2.0@dev"

Installation
------------
Put code into the src/Melk directory.

Configuration
-------------
### Configure FOS User Bundle
Create User entity (read the fos user configuration documentation). For example: ```AppBundle\Entity\User```

### Create referal code entity
Create new entity in your App bundle. For example:
```
namespace AppBundle\Entity;

use Melk\SimpleReferalBundle\Entity\ReferalCode as BaseCode;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ReferalCode
 *
 * @ORM\Entity
 * @ORM\Table(name="my_app_referal_code")
 *
 * @package AppBundle\Entity
 */
class ReferalCode extends BaseCode{

    /**
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     *
     * @var User
     */
    protected $user;

}
```

### Create referal info entity
Create new entity in your App bundle. For example:
```
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Melk\SimpleReferalBundle\Entity\ReferalInfo as BaseInfo;

/**
 * Class ReferalInfo
 *
 * @ORM\Entity
 * @ORM\Table(name="my_app_referal_info")
 *
 * @package AppBundle\Entity
 */
class ReferalInfo extends BaseInfo{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ReferalCode")
     * @ORM\JoinColumn(name="ref_code_id", referencedColumnName="id", onDelete="CASCADE")
     *
     * @var ReferalCode
     */
    protected $refCode;

}
```

### Update config.yml
Configure the bundle:
```
melk_simple_referal:
    code_class: AppBundle\Entity\ReferalCode
    info_class: AppBundle\Entity\ReferalInfo
```

Usage
-----
After all configurations done just use the bundle