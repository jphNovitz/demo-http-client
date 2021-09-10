<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* index.html.twig */
class __TwigTemplate_2bd8aa044902f88f826aade9ca3df582ad8c11addf552905d02ef4a5da9646c9 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "index.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 3
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "    <article class=\"tweeter\">
        ";
        // line 5
        if ( !(null === (isset($context["tweets"]) || array_key_exists("tweets", $context) ? $context["tweets"] : (function () { throw new RuntimeError('Variable "tweets" does not exist.', 5, $this->source); })()))) {
            // line 6
            echo "            <h2 class=\"title\">Derniers tweets
                <span class=\"link\">
                    [<a href=\"https://twitter.com/jphNovitz\" target=\"_blank\">@jphNovitz </a>]
                </span>
            </h2>
            ";
            // line 11
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["tweets"]) || array_key_exists("tweets", $context) ? $context["tweets"] : (function () { throw new RuntimeError('Variable "tweets" does not exist.', 11, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["tweet"]) {
                // line 12
                echo "                <div class=\"tweet\">
                    <div class=\"content\">
                        ";
                // line 14
                if ((twig_get_attribute($this->env, $this->source, $context["tweet"], "image", [], "any", true, true, false, 14) &&  !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["tweet"], "image", [], "any", false, false, false, 14)))) {
                    // line 15
                    echo "                            <div class=\"caption\">
                                <img src=\"";
                    // line 16
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tweet"], "image", [], "any", false, false, false, 16), "html", null, true);
                    echo "\" alt=\"jphNovitz image tweeter\"/> <br/>
                            </div>
                        ";
                }
                // line 19
                echo "                        <div class=\"text\">
                            ";
                // line 20
                echo nl2br(twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tweet"], "text", [], "any", false, false, false, 20), "html", null, true));
                echo "
                        </div>
                    </div>
                    ";
                // line 23
                if ((twig_get_attribute($this->env, $this->source, $context["tweet"], "hashtags", [], "any", true, true, false, 23) &&  !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["tweet"], "hashtags", [], "any", false, false, false, 23)))) {
                    // line 24
                    echo "                        <div class=\"hashtags\">
                            ";
                    // line 25
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["tweet"], "hashtags", [], "any", false, false, false, 25));
                    foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                        // line 26
                        echo "                                #";
                        echo twig_escape_filter($this->env, $context["tag"], "html", null, true);
                        echo "
                            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 28
                    echo "                        </div>
                    ";
                }
                // line 30
                echo "                    <div class=\"link\">
                        <a href=\"";
                // line 31
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tweet"], "link", [], "any", false, false, false, 31), "html", null, true);
                echo "\"
                           target=\"_blank\">
                           Le ";
                // line 33
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tweet"], "date", [], "any", false, false, false, 33), "html", null, true);
                echo "
                        </a>
                    </div>
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tweet'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 38
            echo "        ";
        } else {
            // line 39
            echo "            <p>Probleme de réseau, aucun tweet à afficher</p>
        ";
        }
        // line 41
        echo "    </article>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  147 => 41,  143 => 39,  140 => 38,  129 => 33,  124 => 31,  121 => 30,  117 => 28,  108 => 26,  104 => 25,  101 => 24,  99 => 23,  93 => 20,  90 => 19,  84 => 16,  81 => 15,  79 => 14,  75 => 12,  71 => 11,  64 => 6,  62 => 5,  59 => 4,  52 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block body %}
    <article class=\"tweeter\">
        {% if tweets is not null %}
            <h2 class=\"title\">Derniers tweets
                <span class=\"link\">
                    [<a href=\"https://twitter.com/jphNovitz\" target=\"_blank\">@jphNovitz </a>]
                </span>
            </h2>
            {% for tweet in tweets %}
                <div class=\"tweet\">
                    <div class=\"content\">
                        {% if tweet.image is defined and tweet.image is not empty %}
                            <div class=\"caption\">
                                <img src=\"{{ tweet.image }}\" alt=\"jphNovitz image tweeter\"/> <br/>
                            </div>
                        {% endif %}
                        <div class=\"text\">
                            {{ tweet.text|nl2br }}
                        </div>
                    </div>
                    {% if tweet.hashtags is defined and tweet.hashtags is not empty %}
                        <div class=\"hashtags\">
                            {% for tag in tweet.hashtags %}
                                #{{ tag }}
                            {% endfor %}
                        </div>
                    {% endif %}
                    <div class=\"link\">
                        <a href=\"{{ tweet.link }}\"
                           target=\"_blank\">
                           Le {{ tweet.date }}
                        </a>
                    </div>
                </div>
            {% endfor %}
        {% else %}
            <p>Probleme de réseau, aucun tweet à afficher</p>
        {% endif %}
    </article>
{% endblock %}", "index.html.twig", "/home/jiffy/dev/demo-http-client/templates/index.html.twig");
    }
}
